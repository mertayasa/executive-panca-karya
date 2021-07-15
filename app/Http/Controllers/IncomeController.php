<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeType;
use App\Models\AccountsReceivable;
use Illuminate\Http\Request;
use App\Datatables\IncomeDatatable;
use App\DataTables\IncomeReceivableDataTable;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Log;

class IncomeController extends Controller{
    public function index(){
         return view('income.index');
    }

 
    public function datatable(){
        $income = Income::where('status', 1)->get();

        return IncomeDataTable::set($income);
    }
 
    public function datatableReceivable(){
        $income = Income::where('status', 0)->get();

        return IncomeReceivableDataTable::set($income);
    }

    public function create(){
        $customers = Customer::pluck('name', 'id');
        $income_type = IncomeType::pluck('name', 'id');
        
        if($customers->count() < 1){
            return redirect()->route('customer.index')->with('error', 'Anda belum memiliki pelanggan, silahkan tambah pelanggan terlebih dahulu !');
        }

        if($income_type->count() < 1){
            return redirect()->route('income_type.index')->with('error', 'Anda belum memiliki data jenis pendapatan, silahkan tambah jenis pendapatan terlebih dahulu !');
        }

        return view('income.create', compact('income_type', 'customers'));
    }

    public function store(Request $request){
        try{
            $income = new Income;
            $income->id_income_type   = $request->id_income_type;
            $income->id_customer   = $request->id_customer;
            $income->date   = $request->date;
            $income->total  = $request->total;
            $income->ket    = $request->ket;
            $income->status = $request->status;
            $income->save();
    
            if($request->status == '0'){
                $accounts_receiveables = new AccountsReceivable;
                $accounts_receiveables->id_income = $income->id;
                $accounts_receiveables->pay = 0;
                $accounts_receiveables->remaining_receive = $request->total;
                $accounts_receiveables->save();
            }
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pendapatan, periksa lagi data anda !');
        }

        return redirect('/income')->with('success', 'Data Pendapatan Berhasil Ditambahkan');
    }

    public function show(Income $income){
        return view('income.show', compact('income'));
    }

    public function edit(Income $income){
        $customers = [$income->customer->id => $income->customer->name];
        $income_type = [$income->income_type->id => $income->income_type->name];

        return view('income.edit', compact('income' , 'income_type', 'customers'));
    }

    public function update(Request $request, Income $income){
        try{
            $income->id_income_type   = $request->id_income_type;
            $income->total  = $request->total;
            $income->ket    = $request->ket;
            $income->save();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data pendapatan, mohon periksa lagi data anda !');
        }

        return redirect()->route('income.index')->with('success', 'Berhasil mengubah data pendapatan');
    }

    public function halfPay(Request $request, Income $income){
        try{
            $remaining = $income->remaining_receive - $request->pay;
            
            if($remaining < 0){
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan pembayaran piutang, jumlah pembayaran melebihi jumlah piutang !');
            }

            $income->account_receivable->pay = $request->pay;
            $income->account_receivable->remaining_receive = $remaining;
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan pembayaran piutang, mohon periksa lagi data anda !');
        }

        return redirect()->route('income.index')->with('success', 'Berhasil menyimpan pembayaran piutang');
    }

    public function fullPay(Income $income){
        try{
            $income->status = 1;
            $income->save();
            $income->account_receivable->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal melunasi hutang']);
        }

        return response(['code' => 1, 'message' => 'Berhasil melunasi hutang']);
    }

    public function destroy(Income $income){
        //
    }
}

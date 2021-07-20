<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeType;
use App\Models\AccountsReceivable;
use Illuminate\Http\Request;
use App\Datatables\IncomeDatatable;
use App\DataTables\IncomeReceivableDataTable;
use App\Models\Customer;
use App\Models\ReceivableLog;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IncomeController extends Controller{
    public function index(){
        $income = Income::latest()->get();
        $anual = Income::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');
        $monthly = Income::orderBy('date', 'DESC')->get()->pluck('monthly', 'monthly_raw')->unique();

        $totals = Income::whereMonth('date', Carbon::now())->sum('total');
        $customers = Customer::pluck('name', 'id');
        $income_types = IncomeType::pluck('name', 'id');
        $month_selected = $totals >= 0 ? $income[0]->raw_month : null; 

        return view('income.index', compact('anual', 'monthly', 'totals', 'month_selected', 'income_types', 'customers'));
    }

 
    public function datatable($filter = null){
        $rawQuery = Income::where('status', 1);
        
        if($filter == null){
            $income = $rawQuery->get();
        }else{
            $income = $this->filterDatatable($rawQuery, $filter);
        }

        return IncomeDataTable::set($income);
    }
 
    public function datatableReceivable($filter = null){
        $rawQuery = Income::where('status', 0);

        if($filter == null){
            $income = $rawQuery->get();
        }else{
            $income = $this->filterDatatable($rawQuery, $filter);
        }

        return IncomeReceivableDataTable::set($income);
    }

    public function filterDatatable($rawQuery, $filter){
        $exploded = explode('+', $filter);
        $filter_cust = $exploded[0];
        $filter_income_type = $exploded[1];
        
        $filter_month = $exploded[2];

        if($filter_month){
            $month = explode( '-', $filter_month)[0];
            $year = explode( '-', $filter_month)[1];
    
            $rawQuery->whereMonth('date', $month)->whereYear('date', $year);
        }

        if($filter_cust){
            $rawQuery->where('id_customer', $filter_cust);
        }
        
        if($filter_income_type){
            $rawQuery->where('id_income_type', $filter_income_type);
        }

        return $rawQuery->get();
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
            $income->id_income_type = $request->id_income_type;
            $income->id_customer = $request->id_customer;
            $income->date = $request->date;
            $income->total = $request->total;
            $income->receivable_remain = $request->status == '0' ? $request->total : 0;
            $income->ket = $request->ket;
            $income->created_by = Auth::id();
            $income->updated_by = Auth::id();
            $income->status = $request->status;
            $income->save();
    
            if($request->status == '0'){
                $accounts_receiveables = new ReceivableLog;
                $accounts_receiveables->id_income = $income->id;
                $accounts_receiveables->pay = 0;
                $accounts_receiveables->remain = $request->total;
                $accounts_receiveables->save();
            }

        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pendapatan, periksa lagi data anda !');
        }

        return redirect()->route('income.index')->with('success', 'Data Pendapatan Berhasil Ditambahkan');
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
            $income->updated_by = Auth::id();
            $income->save();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data pendapatan, mohon periksa lagi data anda !');
        }

        return redirect()->route('income.index')->with('success', 'Berhasil mengubah data pendapatan');
    }

    public function fullPay(Income $income){
        try{
            $income->receivable_remain = 0;
            $income->status = 1;
            $income->updated_by = Auth::id();
            $income->save();

            $pay = $income->receivable_log[0]->remain ?? $income->receivable_log->remain;
            $remain = 0;

            $this->storeReceivableLog($income, $remain, $pay);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal melunasi hutang']);
        }

        return response(['code' => 1, 'message' => 'Berhasil melunasi hutang']);
    }

    public function showFormReceivable(Income $income){
        $customers = [$income->customer->id => $income->customer->name];
        $income_type = [$income->income_type->id => $income->income_type->name];

        return view('income.form_pay_receivable', compact('income', 'customers', 'income_type'));
    }

    public function payReceivable(Request $request, Income $income){
        try{
            if(!isset($request->pay) || $request->pay > $income->receivable_remain){
                return redirect()->back()->withInput()->with('error', 'Jumlah pembayaran melebihi jumlah piutang yang harus dibayar');
            }

            $remain = $income->receivable_remain - $request->pay;
            $income->receivable_remain = $remain;
            $income->updated_by = Auth::id();
            
            if($remain == 0){
                $income->status = 1;
            }

            $income->save();

            $this->storeReceivableLog($income, $remain, $request->pay);

        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pembayaran piutang');
        }

        return redirect()->route('income.index')->with(['success' => 'Berhasil menyimpan pembayaran piutang', 'active' => 'incomeNotFix' ]);

    }

    public function storeReceivableLog($income, $remain, $pay){
        $accounts_receiveables = new ReceivableLog;
        $accounts_receiveables->id_income = $income->id;
        $accounts_receiveables->pay = $pay;
        $accounts_receiveables->remain = $remain;
        $accounts_receiveables->save();
    }

    public function destroy(Income $income){
        //
    }
}

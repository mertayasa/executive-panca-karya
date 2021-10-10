<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeType;
use App\Models\AccountsReceivable;
use Illuminate\Http\Request;
use App\Datatables\IncomeDatatable;
use App\DataTables\IncomeReceivableDataTable;
use App\DataTables\IncomeReceivableDataTableDetail;
use App\Models\Customer;
use App\Models\ReceivableLog;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class IncomeController extends Controller
{
    public function index()
    {
        $income = Income::latest()->get();
        $anual = Income::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');
        $monthly = Income::orderBy('date', 'DESC')->get()->pluck('monthly', 'monthly_raw')->unique();

        $totals = Income::whereMonth('date', Carbon::now())->sum('total');
        $customers = Customer::pluck('name', 'id');
        $income_types = IncomeType::pluck('name', 'id');
        $month_selected = $totals >= 0 ? $income[0]->raw_month : null;

        $view = str_contains(FacadesRequest::route()->getName(), 'income') ? 'income.index' : 'income.receivable.index';

        return view($view, compact('anual', 'monthly', 'totals', 'month_selected', 'income_types', 'customers'));
    }

    public function groupCustomer()
    {
        // $rawQuery = Customer::all();
        // $rawQuery = Income::where('status', 0)->get()->groupBy('id_customer');

        $rawQuery = Customer::get()->where('total_receivable', '>', 0);
        dd($rawQuery);

        // $asd = [];
        // foreach($rawQuery as $query){
        //     array_push($asd, $query->total_receivable);
        // }
    }

    public function datatable($filter = null)
    {
        $rawQuery = Income::where('status', 1)->orderBy('created_at', 'DESC');

        if ($filter == null) {
            $income = $rawQuery->get();
        } else {
            $income = $this->filterDatatable($rawQuery, $filter);
        }

        return IncomeDataTable::set($income);
    }

    public function filterDatatable($rawQuery, $filter)
    {
        $exploded = explode('+', $filter);
        $filter_cust = $exploded[0];
        $filter_income_type = $exploded[1];

        $filter_month = $exploded[2];

        if ($filter_month) {
            $month = explode('-', $filter_month)[0];
            $year = explode('-', $filter_month)[1];

            $rawQuery->whereMonth('date', $month)->whereYear('date', $year);
        }

        if ($filter_cust) {
            $rawQuery->where('id_customer', $filter_cust);
        }

        if ($filter_income_type) {
            $rawQuery->where('id_income_type', $filter_income_type);
        }

        $raws = $rawQuery->get();
        $new = $raws;
        // $new = [];

        // foreach ($raws as $raw) {
        //     $raw->paid = $raw->total - $raw->receivable_remain;
        //     array_push($new, $raw);
        // }

        return $new;
    }

    public function create()
    {
        $customers = Customer::pluck('name', 'id');
        $income_type = IncomeType::pluck('name', 'id');

        if ($customers->count() < 1) {
            return redirect()->route('customer.index')->with('error', 'Anda belum memiliki pelanggan, silahkan tambah pelanggan terlebih dahulu !');
        }

        if ($income_type->count() < 1) {
            return redirect()->route('income_type.index')->with('error', 'Anda belum memiliki data jenis pendapatan, silahkan tambah jenis pendapatan terlebih dahulu !');
        }

        $page_context = str_contains(FacadesRequest::route()->getName(), 'income') ? 'Pendapatan' : 'Piutang';

        return view('income.create', compact('income_type', 'customers', 'page_context'));
    }

    public function store(Request $request)
    {
        $income_status = str_contains(FacadesRequest::route()->getName(), 'income') ? '1' : '0';

        try {
            // $income = new Income;
            // $income->id_income_type = $request->id_income_type;
            // $income->id_customer = $request->id_customer;
            // $income->receiver_name = $request->receiver_name ?? Customer::findOrFail($request->id_customer)->name;
            // $income->date = $request->date;
            // $income->total = $request->total;
            // $income->receivable_remain = $income_status == '0' ? $request->total : 0;
            // $income->ket = $request->ket;
            // $income->created_by = Auth::id();
            // $income->updated_by = Auth::id();
            // $income->save();

            // if ($income_status == '0') {
            //     $accounts_receiveables = new ReceivableLog;
            //     $accounts_receiveables->id_income = $income->id;
            //     $accounts_receiveables->pay = 0;
            //     $accounts_receiveables->remain = $request->total;
            //     $accounts_receiveables->save();
            // }

            $income = new Income;

            $last_income = Income::orderBy('id', 'DESC')->first();
            
            if(!$last_income){
                $income->invoice_no = '00001';
            }else{
                $last_invoice = ltrim($last_income->invoice_no, '0');
                $invoice_no = sprintf("%05d", $last_invoice+1);
                $income->invoice_no = $invoice_no;
            }


            $income->id_income_type = $request->id_income_type;
            $income->id_customer = $request->id_customer;
            // $income->receiver_name = $request->receiver_name ?? Customer::findOrFail($request->id_customer)->name;
            $income->status = $request->status;
            if($income->status == 1){
                $income->paid_date = Carbon::today();
            }
            $income->date = $request->date;
            $income->total = $request->total;
            // $income->receivable_remain = $income->status == '0' ? $request->total : 0;
            $income->ket = $request->ket;
            // $income->invoice_no = 
            $income->created_by = Auth::id();
            $income->updated_by = Auth::id();
            
            $income->save();

            if ($income->status == '0') {

                $accounts_receiveables = new ReceivableLog;
                $accounts_receiveables->id_income = $income->id;
                $accounts_receiveables->pay = 0;
                $accounts_receiveables->remain = $request->total;
                $accounts_receiveables->save();
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pendapatan, periksa lagi data anda !');
        }

        // $context = $income_status == 1 ? ['income.index', 'Pendapatan'] : ['receivable.index', 'Piutang'];
        $context = $income->status == 1 ? ['income.index', 'Pendapatan'] : ['receivable.index', 'Piutang'];

        return redirect()->route($context[0])->with('success', 'Data ' . $context[1] . ' Berhasil Ditambahkan');
    }

    public function show(Income $income)
    {
        $url_referer = request()->headers->get('referer');
        // dd($referer);
        return view('income.show', compact('income', 'url_referer'));
    }

    public function edit(Income $income)
    {
        $customers = [$income->customer->id => $income->customer->name];
        $income_type = [$income->income_type->id => $income->income_type->name];

        return view('income.edit', compact('income', 'income_type', 'customers'));
    }

    public function update(Request $request, Income $income)
    {
        try {
            $income->id_income_type   = $request->id_income_type;
            $income->total  = $request->total;
            $income->ket    = $request->ket;
            $income->updated_by = Auth::id();
            $income->receiver_name = $request->receiver_name;
            $income->save();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data pendapatan, mohon periksa lagi data anda !');
        }

        return redirect()->route('income.index')->with('success', 'Berhasil mengubah data pendapatan');
    }


    // ─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────
    // ─████████████████───██████████████─██████████████─██████████████─██████████─██████──██████─██████████████─██████████████───██████─────────██████████████─
    // ─██░░░░░░░░░░░░██───██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░██─██░░██──██░░██─██░░░░░░░░░░██─██░░░░░░░░░░██───██░░██─────────██░░░░░░░░░░██─
    // ─██░░████████░░██───██░░██████████─██░░██████████─██░░██████████─████░░████─██░░██──██░░██─██░░██████░░██─██░░██████░░██───██░░██─────────██░░██████████─
    // ─██░░██────██░░██───██░░██─────────██░░██─────────██░░██───────────██░░██───██░░██──██░░██─██░░██──██░░██─██░░██──██░░██───██░░██─────────██░░██─────────
    // ─██░░████████░░██───██░░██████████─██░░██─────────██░░██████████───██░░██───██░░██──██░░██─██░░██████░░██─██░░██████░░████─██░░██─────────██░░██████████─
    // ─██░░░░░░░░░░░░██───██░░░░░░░░░░██─██░░██─────────██░░░░░░░░░░██───██░░██───██░░██──██░░██─██░░░░░░░░░░██─██░░░░░░░░░░░░██─██░░██─────────██░░░░░░░░░░██─
    // ─██░░██████░░████───██░░██████████─██░░██─────────██░░██████████───██░░██───██░░██──██░░██─██░░██████░░██─██░░████████░░██─██░░██─────────██░░██████████─
    // ─██░░██──██░░██─────██░░██─────────██░░██─────────██░░██───────────██░░██───██░░░░██░░░░██─██░░██──██░░██─██░░██────██░░██─██░░██─────────██░░██─────────
    // ─██░░██──██░░██████─██░░██████████─██░░██████████─██░░██████████─████░░████─████░░░░░░████─██░░██──██░░██─██░░████████░░██─██░░██████████─██░░██████████─
    // ─██░░██──██░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░██───████░░████───██░░██──██░░██─██░░░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─
    // ─██████──██████████─██████████████─██████████████─██████████████─██████████─────██████─────██████──██████─████████████████─██████████████─██████████████─
    // ─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────



    public function datatableReceivable($filter = null)
    {
        // $rawQuery = Income::where('status', 0);

        // if($filter == null){
        //     $income = $rawQuery->get();
        // }else{
        //     $income = $this->filterDatatable($rawQuery, $filter);
        // }

        $receivable = Customer::get()->where('total_receivable', '>', 0);

        return IncomeReceivableDataTable::set($receivable);
    }

    public function datatableReceivableDetail($id_customer, $filter = null)
    {
        $rawQuery = Income::where('status', 0)->where('id_customer', $id_customer);

        if ($filter == null) {
            $receivable = $rawQuery->get();
        } else {
            $receivable = $this->filterDatatable($rawQuery, $filter);
        }

        // $receivable = Customer::get()->where('total_receivable', '>', 0);

        return IncomeReceivableDataTableDetail::set($receivable);
    }


    public function fullPay(Customer $customer)
    {
        try {
            $incomes = Income::where('id_customer', $customer->id)->get();
            foreach ($incomes as $income) {
                // $income->receivable_remain = 0;
                $income->status = 1;
                $income->updated_by = Auth::id();
                $income->paid_date = Carbon::today();
                $income->save();

                // $pay = $income->receivable_log[0]->remain ?? $income->receivable_log->remain;
                // $remain = 0;

                // $this->storeReceivableLog($income, $remain, $pay);
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data pendapatan, mohon periksa lagi data anda !');
        }

        return redirect()->route('income.index')->withInput()->with('success', 'Berhasil melunasi hutang');
    }



    public function singleFullPay(Income $income)
    {
        try {
            // $income->receivable_remain = 0;
            $income->status = 1;
            $income->updated_by = Auth::id();
            $income->paid_date = Carbon::today();
            $income->save();

            // $pay = $income->receivable_log[0]->remain ?? $income->receivable_log->remain;
            $remain = 0;

            // $this->storeReceivableLog($income, $remain, $pay);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal melunasi hutang']);
        }

        return response(['code' => 1, 'message' => 'Berhasil melunasi hutang']);
    }


    // public function storeReceivableLog($income, $remain, $pay)
    // {
    //     $accounts_receiveables = new ReceivableLog;
    //     $accounts_receiveables->id_income = $income->id;
    //     $accounts_receiveables->pay = $pay;
    //     $accounts_receiveables->remain = $remain;
    //     $accounts_receiveables->save();
    // }




    // ============
    public function showFormReceivable(Customer $customer)
    {
        $incomes = Income::where('status', 0)->where('id_customer', $customer->id)->get();

        return view('income.receivable.form_pay_receivable', compact('incomes', 'customer'));
    }

    public function payReceivable(Request $request, Income $income)
    {
        // try {
        //     if (!isset($request->pay) || $request->pay > $income->receivable_remain) {
        //         return response(['code' => 0, 'message' => 'Jumlah pembayaran melebihi jumlah piutang yang harus dibayar']);
        //     }

        //     $remain = $income->receivable_remain - $request->pay;
        //     $income->receivable_remain = $remain;
        //     $income->updated_by = Auth::id();

        //     if ($remain == 0) {
        //         $income->status = 1;
        //         // $income->total  = $income->total + $income->receivable_remain;
        //         // $income->total;
        //     }

        //     $income->save();

        //     $this->storeReceivableLog($income, $remain, $request->pay);
        // } catch (Exception $e) {
        //     Log::info($e->getMessage());
        //     return response(['code' => 0, 'message' => 'Gagal membayar piutang']);
        // }

        // return response(['code' => 1, 'message' => 'Berhasil membayar piutang']);
    }

    public function payCustomAmount(Request $request, Customer $customer)
    {
        // try {
        //     $data = $request->all();
        //     if (!isset($request->pay)) {
        //         return redirect()->back()->withInput()->with('error', 'Jumlah pembayaran tidak boleh kosong');
        //     }

        //     if ($request->pay > $customer->total_receivable) {
        //         return redirect()->back()->withInput()->with('error', 'Jumlah pembayaran melebihi jumlah piutang yang harus dibayar');
        //     }

        //     $incomes = $customer->income()->orderBy('updated_at')->where('receivable_remain', '!=', 0)->get();

        //     $pay_left = $data['pay'];

        //     foreach ($incomes as $income) {
        //         if ($pay_left != 0) {
        //             $remain = max($income->receivable_remain - $pay_left, 0);
        //             $pay_left = max($pay_left - max($income->receivable_remain - $remain, 0), 0);

        //             // dd($pay_left);

        //             $income->receivable_remain = $remain;
        //             $income->updated_by = Auth::id();

        //             if ($remain == 0) {
        //                 $income->status = 1;
        //                 // $income->total = $total;
        //                 // $income->total  = $income->total + $income->receivable_remain;
        //             }

        //             $income->save();

        //             $this->storeReceivableLog($income, $remain, $request->pay);
        //         }
        //     }
        // } catch (Exception $e) {
        //     Log::info($e->getMessage());
        //     return redirect()->back()->withInput()->with('error', 'Gagal membayar piutang');
        // }

        // if ($customer->refresh()->total_receivable != 0) {
        //     return redirect()->route('income.form_receivable', $customer->id)->with('success', 'Berhasil membayar piutang');
        // }

        // return redirect()->route('receivable.index')->with('success', 'Berhasil melunasi piutang ' . $customer->name);
    }


    public function destroy(Income $income)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeType;
use App\Models\AccountsReceivable;
use Illuminate\Http\Request;
use App\Datatables\IncomeDatatable;


class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('income.index');
    }

 
    public function datatable()
    {
        $income = Income::all();

        return IncomeDataTable::set($income);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $income_type = IncomeType::pluck('name', 'id');

          return view('income.create', compact('income_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $income = new Income;
        $income->id_types   = $request->id_types;
        $income->date   = $request->date;
        $income->total  = $request->total;
        $income->ket    = $request->ket;
        $income->status = $request->status;

        $income->save();

        // if($request->status == '0'){
        // $income = new Income;
        // $income->id_types   = $request->id_types;
        // $income->date   = $request->date;
        // $income->total  = $request->total;
        // $income->ket    = $request->ket;
        // $income->status = $request->status;
        // $income->save();
        // }else{
        // $accounts_receiveables = new AccountsReceivable;
        // $accounts_receiveables->column_name = $request->data;
        // $accounts_receivables->id_cust = $request->id_cust;
        // $accounts_receivables->id_incomeType = $request->id_incomeType;
        // $accounts_receivables->date = $request->date;
        // $accounts_receivables->total = $request->total;
        // $accounts_receivables->pay = $request->pay;
        // $accounts_receivables->remaining_receive = $request->remaining_receive;
        // $accounts_receiveables->save ();
// }

        

        return redirect('/income')->with('success', 'Data Pendapatan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        return view('income.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        $income_type = IncomeType::pluck('name', 'id');
        return view('income.edit', compact('income' , 'income_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Income::find($id);
        $update->id_types   = $request->id_types;
        $update->date   = $request->date;
        $update->total  = $request->total;
        $update->ket    = $request->ket;
        $update->status = $request->status;


        $update->save();

        return redirect('/income')->with('info', 'Data Pendapatan Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}

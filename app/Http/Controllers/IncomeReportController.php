<?php

namespace App\Http\Controllers;

use App\Models\IncomeReport;
use App\Models\Income;
use App\Models\IncomeType;
use Illuminate\Http\Request;

class IncomeReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $income = Income::all();
         return view('income_report.index', compact('income'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomeReport  $incomeReport
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeReport $incomeReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomeReport  $incomeReport
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeReport $incomeReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomeReport  $incomeReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeReport $incomeReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeReport  $incomeReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeReport $incomeReport)
    {
        //
    }
}

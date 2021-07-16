<?php

namespace App\Http\Controllers;

use App\Models\ExpenditureReport;
use App\Models\Expenditure;
use App\Models\ExpenditureType;
use Illuminate\Http\Request;

class ExpenditureReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditure = Expenditure::all();
         return view('expenditure_report.index', compact('expenditure'));
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
     * @param  \App\Models\ExpenditureReport  $expenditureReport
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenditureReport $expenditureReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenditureReport  $expenditureReport
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenditureReport $expenditureReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenditureReport  $expenditureReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenditureReport $expenditureReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenditureReport  $expenditureReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenditureReport $expenditureReport)
    {
        //
    }
}

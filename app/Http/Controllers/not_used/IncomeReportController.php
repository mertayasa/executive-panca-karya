<?php

namespace App\Http\Controllers;

use App\DataTables\IncomeReportDataTable;
use App\Models\IncomeReport;
use App\Models\Income;
use App\Models\IncomeType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeReportController extends Controller{

    public function index(){

        $income = Income::latest()->get();
        $anual = Income::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');
        $monthly = Income::orderBy('date', 'DESC')->get()->pluck('monthly', 'monthly_raw')->unique();

        $totals = Income::whereMonth('date', Carbon::now())->sum('total');
        $month_selected = $totals == 0 ? $income[0]->raw_month : Carbon::now()->format('m-Y'); 

        return view('income_report.index', compact('income', 'monthly', 'totals', 'month_selected'));
    }

    public function datatable($filter_month = null){
        $month = '';
        $year = '';
        
        if($filter_month == null){
            $month = Carbon::now();
            $year = Carbon::now();
        }else{
            $month = explode( '-', $filter_month)[0];
            $year = explode( '-', $filter_month)[1];
        }

        $income = Income::whereMonth('date', $month)->whereYear('date', $year)->get();

        return IncomeReportDataTable::set($income);
    }

}

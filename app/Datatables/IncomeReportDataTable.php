<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeReportDataTable
{

    static public function set($income){
        return Datatables::of($income)
            ->editColumn('total', function($income){
                return formatPrice($income->total);
            })
            ->editColumn('date', function($income){
                return indonesianDate($income->date);
            })->addIndexColumn()->make(true);
    }
}

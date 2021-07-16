<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeReceivableDataTable{
    static public function set($income){
        return Datatables::of($income)
            ->editColumn('total', function($income){
                return formatPrice($income->total);
            })
            ->addColumn('paid', function($income){
                return formatPrice($income->total - $income->receivable_remain);
            })
            ->editColumn('receivable_remain', function($income){
                return formatPrice($income->receivable_remain);
            })
            ->editColumn('date', function($income){
                return indonesianDate($income->date);
            })
            ->editColumn('status', function($income){
                if($income->status == 0){
                    return 'Piutang';
                }

                return 'Lunas';
            })
            ->addColumn('action', function ($income) {
                $customer_name = $income->customer->name;
                $remaining = formatPrice($income->receivable_remain);
                $full_pay = "'".route('income.full_pay', $income->id)."', '$customer_name', '$remaining'";
                return '<div class="btn-group">' .
                    // '<a href="' . route('income.edit', $income->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    // '<a href="' . route('income.show', $income->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" style="margin-right: 5px" ><i class="menu-icon fas fa-info"></i></a>' .
                    '<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Options"> <i class="fas fa-filter"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" onclick="fullPay('. $full_pay .')">Lunasi</a>
                            <a class="dropdown-item" href="'. route('income.form_receivable', $income->id) .'">Bayar Piutang</a>
                        </div>' .
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

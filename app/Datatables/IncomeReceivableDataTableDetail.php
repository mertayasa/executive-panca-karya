<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeReceivableDataTableDetail{
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
                $full_pay = "'".route('income.single_full_pay', $income->id)."', '$customer_name', '$remaining'";
                return 
                '<div class="btn-group">' .
                    '<a href="#" onclick="fullPay('. $full_pay .')" class="btn btn-warning mr-2 rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Bayar Piutang" > Bayar </a>' .
                    '<a href="#" onclick="fullPay('. $full_pay .')" class="btn btn-danger rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Bayar Piutang" > Lunas </a>' .
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

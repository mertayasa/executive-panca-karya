<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeReceivableDataTable{
    static public function set($customer){
        return Datatables::of($customer)
            ->editColumn('total_receivable', function($customer){
                return formatPriceRaw($customer->total_receivable);
            })
            // ->editColumn('total', function($income){
            //     return formatPrice($income->total);
            // })
            // ->editColumn('paid', function($income){
            //     return formatPrice($income->paid);
            // })
            // ->editColumn('receivable_remain', function($income){
            //     return formatPrice($income->receivable_remain);
            // })
            // ->editColumn('date', function($income){
            //     return indonesianDate($income->date);
            // })
            ->addColumn('action', function ($customer) {
                $full_pay = "'".route('income.full_pay', $customer->id)."', '$customer->name', '$customer->total_receivable'";
                return '<div class="btn-group">' .
                    '<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Options"> <i class="fas fa-filter"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" onclick="fullPay('. $full_pay .')">Lunasi</a>
                            <a class="dropdown-item" href="'. route('income.form_receivable', $customer->id) .'">Bayar Piutang</a>
                        </div>' .
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

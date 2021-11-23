<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeReceivableDataTableDetail
{
    static public function set($income)
    {
        return Datatables::of($income)
            ->editColumn('total', function ($income) {
                return formatPriceRaw($income->total);
            })
            // ->addColumn('paid', function ($income) {
            //     return formatPriceRaw($income->total - $income->receivable_remain);
            // })
            // ->editColumn('receivable_remain', function ($income) {
            //     return formatPriceRaw($income->receivable_remain);
            // })
            ->editColumn('date', function ($income) {
                return indonesianDateNew($income->date);
            })
            ->editColumn('status', function ($income) {
                if ($income->status == 0) {
                    return 'Piutang';
                }

                return 'Lunas';
            })
            ->addColumn('action', function ($income) {
                if(getRoleName() == 'pimpinan'){
                    return '<a href="' . route('income.show', $income->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" style="margin-right: 5px" >Detail</a>';
                }

                $customer_name = str_replace("'", '', $income->customer->name);
                $income_total = formatPriceRaw($income->total);
                // $remaining = formatPrice($income->receivable_remain);
                $full_pay = "'" . route('income.single_full_pay', $income->id) . "', '$customer_name', '$income_total'";
                // $single_pay = "'" . route('income.pay_receivable', $income->id) . "', '$customer_name', '$income->receivable_remain', '$income->id'";

                return
                    '<div class="btn-group">' .
                    // '<button type="button" onclick="populateModal(' . $single_pay . ')" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                    //     Bayar
                    // </button>' .
                    '<a href="javascript:void(0)" onclick="fullPay(' . $full_pay . ')" class="btn btn-warning rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Bayar Piutang" > Bayar </a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeReceivableDataTable
{
    static public function set($customer)
    {
        return Datatables::of($customer)
            ->editColumn('total_receivable', function ($customer) {
                return formatPriceRaw($customer->total_receivable);
            })
            ->addColumn('raw_total_receivable', function ($customer) {
                return $customer->total_receivable;
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
            // ->addColumn('total', function($customer){

            // })
            // ->editColumn('created_at', function ($customer) {
            //     return indonesianDateNew($customer->date);
            // })
            ->addColumn('action', function ($customer) {
                if(getRoleName() == 'owner'){
                    return  '<a href="' . route('income.form_receivable', $customer->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat Detail" style="margin-right: 5px">Detail</a>';
                }

                $full_pay = "'" . route('income.full_pay', $customer->id) . "', '$customer->name', '$customer->total_receivable'";

                return '<div class="btn-group">' .
                    // '<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Options"> <i class="fas fa-filter"></i></a>
                    //     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    //         <a class="dropdown-item" href="#" onclick="fullPay(' . $full_pay . ')">Lunasi</a>
                    //         <a class="dropdown-item" href="' . route('income.form_receivable', $customer->id) . '">Bayar Piutang</a>
                    //     </div>' .

                    // '<a href="' . route('income.reivable.info', $customer->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .


                    '<a href="' . route('income.form_receivable', $customer->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px">Bayar</a>' .

                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

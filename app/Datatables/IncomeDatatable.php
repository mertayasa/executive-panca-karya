<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeDataTable
{

    static public function set($income)
    {
        return Datatables::of($income)
            ->editColumn('total', function ($income) {
                return formatPriceRaw($income->total);
            })
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
                if(getRoleName() == 'owner'){
                    return '<a href="' . route('income.show', $income->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" style="margin-right: 5px" >Detail</a>';
                }

                return '<div class="btn-group">' .
                    '<a href="' . route('income.edit', $income->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                    '<a href="' . route('income.show', $income->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" style="margin-right: 5px" >Detail</a>' .
                    // '<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Options"> <i class="fas fa-filter"></i></a>
                    //     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    //         <a class="dropdown-item disabled" href="#">Options</a>
                    //         <a class="dropdown-item" href="#">Pembayaran Piutang</a>
                    //     </div>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

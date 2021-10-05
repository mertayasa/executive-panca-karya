<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class ExpenditureDataTable
{

    static public function set($expenditure)
    {
        return Datatables::of($expenditure)
            ->editColumn('amount', function ($expenditure) {
                return formatPriceRaw($expenditure->amount);
            })
            ->editColumn('date', function ($expenditure) {
                return indonesianDateNew($expenditure->date);
            })
            ->editColumn('note', function ($expenditure) {
                $file_name = explode('/', $expenditure->note)[1] ?? '-';
                $folder = explode('/', $expenditure->note)[0] ?? '-';

                return '<a target="_blank" href="'. asset('images/'.$folder.'/pdf'.'/'.$file_name.'.pdf') .'">
                    <img src="' . asset('images/' . $expenditure->note) . '" alt="" width="100px">
                </a>';
                return '<img src="' . asset('images/' . $expenditure->note) . '" alt="" width="100px">';
            })
            ->addColumn('action', function ($expenditure) {
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('expenditure.edit', $expenditure->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    // '<a href="' . route('income.show', $income->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" style="margin-right: 5px" ><i class="menu-icon fas fa-info"></i></a>' .
                    // '<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Options"> <i class="fas fa-filter"></i></a>
                    //     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    //         <a class="dropdown-item disabled" href="#">Options</a>
                    //         <a class="dropdown-item" href="#">Pembayaran Piutang</a>
                    //     </div>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'note'])->make(true);
    }
}

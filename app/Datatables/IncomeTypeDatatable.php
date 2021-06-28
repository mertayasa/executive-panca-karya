<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class IncomeTypeDataTable
{

    static public function set($income_type)
    {
        return Datatables::of($income_type)
            ->addColumn('action', function ($income_type) {
                return
                '<div class="btn-group">' .
                    '<a href="' . route('income_type.edit', $income_type->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

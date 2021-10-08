<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class ExpenditureTypeDataTable
{

    static public function set($expenditure_type)
    {
        return Datatables::of($expenditure_type)
            ->addColumn('action', function ($expenditure_type) {
                return
                '<div class="btn-group">' .
                    '<a href="' . route('expenditure_type.edit', $expenditure_type->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

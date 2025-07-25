<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class StaffDataTable
{

    static public function set($staff)
    {
        return Datatables::of($staff)
            ->editColumn('date', function($staff){
                return indonesianDateNew($staff->date);
            })
            ->editColumn('gender', function($staff){
                return getGender($staff->gender);
            })
            ->addColumn('action', function ($staff) {
                return
                '<div class="btn-group">' .
                    '<a href="' . route('staff.edit', $staff->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                    // '<a href="' . route('staff.show', $staff->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" style="margin-right: 5px" ><i class="menu-icon fas fa-info"></i></a>' .
                    // '<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Options"> <i class="fas fa-filter"></i></a>
                    //     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    //         <a class="dropdown-item disabled" href="#">Options</a>
                    //         <a class="dropdown-item" href="#">Pembayaran Piutang</a>
                    //     </div>' .
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

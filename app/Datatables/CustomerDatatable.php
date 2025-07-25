<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class CustomerDataTable
{

    static public function set($customer)
    {
        return Datatables::of($customer)
            ->editColumn('status', function ($customer) {
                return $customer->status == 0 ? 'Tidak Aktif' : 'Aktif';
            })
            ->editColumn('category', function ($customer) {
                return getCategory($customer->category);
            })
            ->addColumn('action', function ($customer) {
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('customer.edit', $customer->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                    // '<a href="' . route('customer.show', $customer->id) . '" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" style="margin-right: 5px" ><i class="menu-icon fas fa-info"></i></a>' .
                    '</div>';
                // '<a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Options"> <i class="fas fa-filter"></i></a>';
                // <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                //     <a class="dropdown-item disabled" href="#">Options</a>
                //     <a class="dropdown-item" href="#">Pembayaran Piutang</a>
                // </div>' .
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}

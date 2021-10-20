<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Datatables\CustomerDatatable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index');
    }

    public function datatable()
    {
        $customer = Customer::all();

        return CustomerDataTable::set($customer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name           = $request->name;
        $customer->address        = $request->address;
        $customer->no_telp        = $request->no_telp;
        // $customer->place_of_birth = $request->place_of_birth;
        // $customer->date           = $request->date;
        // $customer->gender         = $request->gender;
        $customer->status = 1;
        $customer->category = $request->category;
        $customer->save();

        return redirect('/customer')->with('success', 'Data Pelanggan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $update = Customer::find($id);
        $update->name            = $request->name;
        $update->address         = $request->address;
        $update->no_telp         = $request->no_telp;
        // $update->place_of_birth  = $request->place_of_birth;
        // $update->date            = $request->date;
        // $update->gender          = $request->gender;
        $update->status          = $request->status;
        $update->category = $request->category;

        $update->save();

        return redirect('/customer')->with('info', 'Data Pelanggan Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\IncomeType;
use Illuminate\Http\Request;
use App\Datatables\IncomeTypeDatatable;

class IncomeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('income_type.index');
    }

    public function datatable()
    {
        $income_type = IncomeType::all();

        return IncomeTypeDataTable::set($income_type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('income_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $income_type = new IncomeType;
        $income_type->name = $request->name;

        $income_type->save();

        return redirect('/income_type')->with('success', 'Data Jenis Pendapatan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomeType  $income_type
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeType $income_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomeType  $income_type
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeType $income_type)
    {
        return view('income_type.edit', compact('income_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomeType  $income_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = IncomeType::find($id);
        $update->name = $request->name;

        $update->save();

        return redirect('/income_type')->with('info', 'Data Jenis Pendapatan Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeType  $income_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeType $incomeType)
    {
        //
    }
}

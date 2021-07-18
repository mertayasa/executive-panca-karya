<?php

namespace App\Http\Controllers;

use App\Models\IncomeType;
use Illuminate\Http\Request;
use App\Datatables\IncomeTypeDatatable;

class IncomeTypeController extends Controller
{
    public function index(){
        return view('income_type.index');
    }

    public function datatable()
    {
        $income_type = IncomeType::all();

        return IncomeTypeDataTable::set($income_type);
    }

    public function create(){
        return view('income_type.create');
    }

    public function store(Request $request){
        $income_type = new IncomeType;
        $income_type->name = $request->name;

        $income_type->save();

        return redirect()->route('income_type.index')->with('success', 'Data Jenis Pendapatan Berhasil Ditambahkan');
    }

    public function show(IncomeType $income_type){
        //
    }

    public function edit(IncomeType $income_type){
        return view('income_type.edit', compact('income_type'));
    }

    public function update(Request $request, $id){
        $update = IncomeType::find($id);
        $update->name = $request->name;

        $update->save();

        return redirect()->route('income_type.index')->with('info', 'Data Jenis Pendapatan Berhasil Diedit');
    }

    public function destroy(IncomeType $incomeType){
        //
    }
}

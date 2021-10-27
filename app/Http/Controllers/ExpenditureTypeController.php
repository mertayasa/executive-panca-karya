<?php

namespace App\Http\Controllers;

use App\Models\ExpenditureType;
use Illuminate\Http\Request;
use App\Datatables\ExpenditureTypeDatatable;
use Exception;
use Illuminate\Support\Facades\Log;

class ExpenditureTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expenditure_type.index');
    }

    public function datatable()
    {
        $expenditure_type = ExpenditureType::all();

        return ExpenditureTypeDataTable::set($expenditure_type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenditure_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $expenditure_type = new ExpenditureType;
            $expenditure_type->name = $request->name;
    
            $expenditure_type->save();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data jenis pengeluaran');
        }

        return redirect()->route('expenditure_type.index')->with('success', 'Berhasil menambahkan data jenis pendapatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenditureType  $expenditure_type
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenditureType $expenditure_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenditureType  $expenditure_type
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenditureType $expenditure_type)
    {
        return view('expenditure_type.edit', compact('expenditure_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenditureType  $expenditure_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $update = ExpenditureType::find($id);
            $update->name = $request->name;
    
            $update->save();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data jenis pengeluaran');
        }

        return redirect()->route('expenditure_type.index')->with('info', 'Berhasil mengubah data jenis pengeluaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenditureType  $expenditure_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenditureType $expenditure_type)
    {
        //
    }
}

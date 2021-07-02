<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\ExpenditureType;
use Illuminate\Http\Request;
use App\Datatables\ExpenditureDatatable;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expenditure.index');
    }

    public function datatable()
    {
        $expenditure = Expenditure::all();

        return ExpenditureDataTable::set($expenditure);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenditure_type = ExpenditureType::pluck('name', 'id');

        return view('expenditure.create', compact('expenditure_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
            $base_64_foto = json_decode($request['note'], true);
            $upload_image = uploadFile($base_64_foto);

            if($upload_image == 0){
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
            }

            $data['note'] = $upload_image;


        $expenditure = new Expenditure;
        $expenditure->id_types   = $data['id_types'];
        $expenditure->date       = $data['date'];
        $expenditure->amount     = $data['amount'];
        $expenditure->note       = $data['note'];

        $expenditure->save();


        return redirect('/expenditure')->with('success', 'Data Pengeluaran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function show(Expenditure $expenditure)
    {
        return view('expenditure.show', compact('expenditure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenditure $expenditure)
    {
        $expenditure_type = ExpenditureType::pluck('name', 'id');
        return view('expenditure.edit', compact('expenditure' , 'expenditure_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
            $base_64_foto = json_decode($request['note'], true);
            $upload_image = uploadFile($base_64_foto);

            if($upload_image == 0){
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
            }

            $data['note'] = $upload_image;


        $expenditure = Expenditure::find($id);
        $expenditure->id_types   = $data['id_types'];
        $expenditure->date       = $data['date'];
        $expenditure->amount     = $data['amount'];
        $expenditure->note       = $data['note'];

        $expenditure->save();

        return redirect('/expenditure')->with('info', 'Data Pengeluaran Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenditure $expenditure)
    {
        //
    }
}

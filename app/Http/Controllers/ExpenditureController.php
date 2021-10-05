<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\ExpenditureType;
use Illuminate\Http\Request;
use App\Datatables\ExpenditureDatatable;
use ConvertApi\ConvertApi;
use Illuminate\Support\Facades\Auth;

class ExpenditureController extends Controller{

    public function index(){
        // $expenditure = Expenditure::find(1);
        // dd(explode('/', $expenditure->note)[1]);
        return view('expenditure.index');
    }

    public function datatable(){
        $expenditure = Expenditure::all();

        return ExpenditureDataTable::set($expenditure);
    }

    public function create(){
        $expenditure_type = ExpenditureType::pluck('name', 'id');

        return view('expenditure.create', compact('expenditure_type'));
    }

    public function store(Request $request){
        $data = $request->all();
        $base_64_foto = json_decode($request['note'], true);
        $upload_image = uploadFile($base_64_foto, 'expenditure', true);

        if($upload_image === 0){
            return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
        }

        $data['note'] = $upload_image;

        $expenditure = new Expenditure;
        $expenditure->id_types   = $data['id_types'];
        $expenditure->date       = $data['date'];
        $expenditure->amount     = $data['amount'];
        $expenditure->note       = $data['note'];
        $expenditure->created_by = Auth::id();
        $expenditure->updated_by = Auth::id();

        $expenditure->save();


        return redirect('/expenditure')->with('success', 'Data Pengeluaran Berhasil Ditambahkan');
    }

    public function show(Expenditure $expenditure){
        return view('expenditure.show', compact('expenditure'));
    }

    public function edit(Expenditure $expenditure){
        $expenditure_type = ExpenditureType::pluck('name', 'id');
        return view('expenditure.edit', compact('expenditure' , 'expenditure_type'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $base_64_foto = json_decode($request['note'], true);
        $upload_image = uploadFile($base_64_foto, 'expenditure', true);
        if($upload_image === 0){
            return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
        }

        $data['note'] = $upload_image;


        $expenditure = Expenditure::find($id);
        $expenditure->id_types   = $data['id_types'];
        $expenditure->date       = $data['date'];
        $expenditure->amount     = $data['amount'];
        $expenditure->note       = $data['note'];
        $expenditure->updated_by = Auth::id();

        $expenditure->save();

        return redirect('/expenditure')->with('info', 'Data Pengeluaran Berhasil Diedit');
    }

    public function destroy(Expenditure $expenditure){
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\ExpenditureType;
use Illuminate\Http\Request;
use App\Datatables\ExpenditureDatatable;
use App\Http\Requests\ExpenditureRequest;
use ConvertApi\ConvertApi;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\ExpenditurePrintRequest;


use Illuminate\Support\Facades\Auth;

class ExpenditureController extends Controller
{

    public function index()
    {
        // $expenditure = Expenditure::find(1);
        // dd(explode('/', $expenditure->note)[1]);
        return view('expenditure.index');
    }

    public function datatable()
    {
        $expenditure = Expenditure::all();

        return ExpenditureDataTable::set($expenditure);
    }

    public function create()
    {
        $expenditure_type = ExpenditureType::pluck('name', 'id');

        return view('expenditure.create', compact('expenditure_type'));
    }

    public function store(ExpenditureRequest $request)
    {
        $data = $request->all();
        $base_64_foto = json_decode($request['note'], true);
        $upload_image = uploadFile($base_64_foto, 'expenditure', true);

        if ($upload_image === 0) {
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

    public function show(Expenditure $expenditure)
    {
        $url_referer = request()->headers->get('referer');
        $check_folder = explode('/', $expenditure->note);
        $raw_file_name = $check_folder[array_key_last($check_folder)];

        if (!file_exists('images/expenditure/pdf/'. $raw_file_name.'.pdf')) {
            $new_pdf = $this->generatePdf($expenditure->note);
            $note = asset('images/expenditure/pdf' . '/' . $new_pdf . '.pdf');
        }else{
            $note = asset('images/expenditure/pdf' . '/' . $raw_file_name . '.pdf');
        }

        return view('expenditure.show', compact('expenditure', 'url_referer', 'note'));
    }

    private function generatePdf($raw_file_dir)
    {
        if (!file_exists('images/expenditure/pdf')) {
            mkdir('images/expenditure/pdf', 0755, true);
        }

        $check_folder = explode('/', $raw_file_dir);
        $new_file_name = $check_folder[array_key_last($check_folder)];
        $safe_name = $new_file_name;
        // dd($safe_name);

        ConvertApi::setApiSecret(env('CONVERT_API_KEY'));
        $result = ConvertApi::convert('pdf', ['File' => 'images/'. $raw_file_dir]);
        $result->getFile()->save(base_path() . '/public/images/expenditure/' . 'pdf/' . $safe_name . '.pdf');

        return $safe_name;

    }

    public function edit(Expenditure $expenditure)
    {
        $expenditure_type = ExpenditureType::pluck('name', 'id');
        return view('expenditure.edit', compact('expenditure', 'expenditure_type'));
    }

    public function update(ExpenditureRequest $request, $id)
    {
        $data = $request->all();
        $base_64_foto = json_decode($request['note'], true);
        $upload_image = uploadFile($base_64_foto, 'expenditure', true);
        if ($upload_image === 0) {
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

    public function destroy(Expenditure $expenditure)
    {
        //
    }


    public function printForm()
    {
        return view('expenditure.print_form');
    }

    public function searchForPrint(ExpenditurePrintRequest $request)
    {
        $expenditure_data = Expenditure::whereBetween('date', [$request->start_date, $request->end_date])->get();
        // $expenditure_data = expenditure::whereBetween('date', ['2021-11-14', '2021-11-17'])->get();
        // dd($expenditure_data);
        return view('expenditure.print_form', compact('expenditure_data', 'request'));
    }

    public function print($start_date, $end_date)
    {
        $expenditure_data = Expenditure::whereBetween('date', [$start_date, $end_date])->get();
        $pdf = PDF::loadview('expenditure.export_pdf', ['expenditure_data' => $expenditure_data, 'start_date' => $start_date, 'end_date' => $end_date])->setPaper('a4', 'landscape');
        return $pdf->download('Pengeluaran' . $start_date . '-' . $end_date . '.pdf');
    }
}

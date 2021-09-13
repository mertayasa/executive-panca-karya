<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use App\Datatables\StaffDatatable;
use App\Http\Requests\StaffRequest;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller{

    public function index(){
        return view('staff.index');
    }

    public function datatable(){
        $staff = Staff::all();

        return StaffDataTable::set($staff);
    }

    public function create(){
        return view('staff.create');
    }

    public function store(StaffRequest $request){
        try{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
    
            $user->save();
    
            $staff = new Staff;
            $staff->id_user = $user->id;
            $staff->date = $request->date;
            $staff->gender = $request->gender;
            $staff->telp = $request->telp;
            $staff->address = $request->address;
    
           $staff->save();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan Dokter !');
        }

        return redirect('/staff')->with('success', 'Data Staff Berhasil Ditambahkan');
    }


    public function show(Staff $staff){
        //
    }

    public function edit(Staff $staff){
        return view('staff.edit', compact('staff'));
    }

    public function update(StaffRequest $request, Staff $staff){
        try{
            $user = User::find($staff->id_user);
            $user->name = $request->name;
            if($user->email != $request->email){
                $user->email = $request->email;
            }
            
            if($request->password!=null){
                $user->password= bcrypt($request->password);
            }
    
            $user->update();
    
            $staff->id_user = $user->id;
            $staff->date = $request->date;
            $staff->gender = $request->gender;
            $staff->telp = $request->telp;
            $staff->address = $request->address;
    
            $staff->update();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data staff');
        }

        return redirect('/staff')->with('success', 'Berhasil mengubah data staff');
    }

    public function destroy(Staff $staff){
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use App\Datatables\StaffDatatable;
use App\Http\Requests\StaffRequest;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.index');
    }

     public function datatable(){
        $staff = Staff::all();

        return StaffDataTable::set($staff);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
         try{
            $user = new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password= bcrypt ($request->password);
    
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

        return redirect('/staff')->with('info', 'Data Staff Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
          return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, Staff $staff){
        try{
            $user = User::find($staff->id_user);
            $user->name=$request->name;
            if($user->email!=$request->email){
                $user->email=$request->email;
            }
            
            if($request->password!=null){
                    $user->password= bcrypt ($request->password);
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
            return redirect('')->back()->withInput()->with('error', 'Data Dokter Gagal Diubah');
        }

        return redirect('/staff')->with('info', 'Data Dokter Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}

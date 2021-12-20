<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\StaffRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(){
        //
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(){
        //
    }

    public function edit(){
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(ProfileRequest $request, User $user){
        try{
            DB::transaction(function () use($user, $request) {
                if($user->level == 0){
                    $user->staff->update($request->validated());
                }

                $validated = $request->validated();
                if($validated['password'] != null){
                    $validated['password'] = bcrypt($validated['password']);
                }
                $user->update($validated);
            }, 5);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengubah profil');
        }

        return redirect()->back()->withInput()->with('success', 'Berhasil mengubah profil');
    }

    public function destroy(){
       //
    }
}

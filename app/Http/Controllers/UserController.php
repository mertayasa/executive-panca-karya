<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
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
        return view('profile.edit');
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy(){
       //
    }
}

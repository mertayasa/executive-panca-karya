<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model{

    use HasFactory;

    public $with = [
        'user'
    ];


    public function getNameAttribute(){
        return $this->user->name;
    }

    public function getEmailAttribute(){
        return $this->user->email;
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user');
    }
    
}
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function staff(){
        return $this->hasOne('App\Models\Staff', 'id_user');
    }

    public function getDateAttribute(){
        return $this->staff->date;
    }

    public function getAddressAttribute(){
        return $this->staff->address;
    }

    public function getGenderAttribute(){
        return $this->staff->gender;
    }

    public function getTelpAttribute(){
        return $this->staff->telp;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_income_type',
        'date',
        'total',
        'ket',
        'receivable_remain',
        'status'
    ];

    public $with = [
        'income_type', 'customer', 'receivable_log'
    ];


    public function income_type(){
        return $this->belongsTo('App\Models\IncomeType', 'id_income_type');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

    public function receivable_log(){
        return $this->hasMany('App\Models\ReceivableLog', 'id_income');
    }

    // public function account_receivable(){
    //     return $this->hasOne('App\Models\AccountsReceivable', 'id_income');
    // }

    // public function getTotalAttribute(){
    //     if($this->status == 0){
    //         return $this->account_receivable->pay;
    //     }

    //     return $this->attributes['total'];
    // }

}





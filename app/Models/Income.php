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
        'status'
    ];

    public $with = [
        'income_type', 'account_receivable', 'customer'
    ];


    public function income_type(){
        return $this->belongsTo('App\Models\IncomeType', 'id_income_type');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

    public function account_receivable(){
        return $this->hasOne('App\Models\AccountsReceivable', 'id_income');
    }

    public function getTotalAttribute(){
        if($this->status == 0){
            return $this->account_receivable->pay;
        }

        return $this->attributes['total'];
    }

}





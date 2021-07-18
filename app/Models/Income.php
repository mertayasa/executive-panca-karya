<?php

namespace App\Models;

use Carbon\Carbon;
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
        'status',
        'created_by',
        'updated_by',
    ];

    public $with = [
        'income_type', 'customer', 'receivable_log', 'created_by', 'updated_by'
    ];


    public function income_type(){
        return $this->belongsTo('App\Models\IncomeType', 'id_income_type');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

    public function created_by(){
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updated_by(){
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function receivable_log(){
        return $this->hasMany('App\Models\ReceivableLog', 'id_income');
    }

    public function getMonthlyAttribute(){
        $date = Carbon::parse($this->attributes['date'])->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        return $date->format('F Y');
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





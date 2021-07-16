<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsReceivable extends Model
{
    use HasFactory;
    
    public $with = [
        'incomeType', 'customer'
    ];

    public function incomeType(){
        return $this->belongsTo('App\Models\IncomeType', 'id_incomeType');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

}

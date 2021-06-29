<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;


      public $with = [
        'income_type'
    ];


   public function income_type()
    {
        return $this->belongsTo('App\Models\IncomeType', 'id_types');
    }

}





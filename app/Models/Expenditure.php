<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    public $with = [
        'expenditure_type'
    ];


   public function expenditure_type()
    {
        return $this->belongsTo('App\Models\ExpenditureType', 'id_types');
    }
}

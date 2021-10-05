<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureType extends Model{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function expenditures(){
        return $this->hasMany('App\Models\Expenditure', 'id_types');
    }

    public function getExpenditureSumAttribute(){
        return $this->expenditures->sum('amount');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    use HasFactory;

    public function incomes(){
        return $this->hasMany('App\Models\Income', 'id_income_type');
    }

    public function getIncomeSumAttribute(){
        return $this->incomes->sum('total');
    }
}

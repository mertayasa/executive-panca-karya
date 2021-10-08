<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function income(){
        return $this->hasMany('App\Models\Income', 'id_customer');
    }

    // protected $appends = [
    //     'total_receivable'
    // ];

    public function getTotalIncomeAttribute(){
        $sum = 0;
        foreach($this->income as $income){
            $sum =  $sum + $income->total;
        }

        return $sum;
    }

    public function getTotalReceivableAttribute(){
        $sum = 0;
        foreach($this->income as $income){
            if($income->status == 0){
                $sum =  $sum + $income->total;
            }
        }
        
        return $sum;
    }

    public function getPaidAmountAttribute(){
        $paid = 0;
        foreach($this->income as $income){
            $paid =  $paid + $income->total - $income->receivable_remain;
        }

        return $paid;
    }
}

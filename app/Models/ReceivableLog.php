<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivableLog extends Model{
    use HasFactory;

    protected $fillable = [
        'id_income',
        'pay',
        'remain'
    ];

    public function income(){
        return $this->belongsTo('App\Models\Income', 'id_income');
    }

    protected static function boot()
    {
        parent::boot();
     
        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'DESC');
        });
    }

}

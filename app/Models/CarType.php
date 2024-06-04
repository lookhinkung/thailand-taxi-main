<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function car(){
        return $this->belongsTo(Car::class, "id",'cartype_id');
        
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function type(){
        return $this->belongsTo(CarType::class, "cartype_id",'id');
    }

    public function car_numbers(){
        return $this->hasMany(CarNumber::class, 'car_id')->where('status','Active');
    }
}

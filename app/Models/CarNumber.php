<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarNumber extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function car_type(){

        return $this->belongsTo(CarType::class,'car_type_id','id');
    }

    public function last_booking(){
        return $this->hasOne(BookingCarList::class,'car_number_id','id');
    }
}

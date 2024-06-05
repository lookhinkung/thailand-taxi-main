<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCarList extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function car_number(){
        return $this->belongsTo(CarNumber::class,'car_number_id','id');
    }

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id','id');
    }
}

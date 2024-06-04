<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nationality',
        'person',
        'name',
        'email',
        'phone',
        'check_in',
        'pick_from',
        'drop_to',
        'msg',
    ];
    public function assign_cars(){
        return $this->hasMany(BookingCarList::class,'booking_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function car(){
        return $this->belongsTo(Car::class,'car_id','id');
    }

    
}

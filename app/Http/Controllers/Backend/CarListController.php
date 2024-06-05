<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarNumber;
use Illuminate\Support\Facades\Session;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Car;
use App\Models\CarBookedDate;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\BookingCarList;

use Illuminate\Support\Facades\Log;

class CarListController extends Controller
{
    public function ViewCarList(){

        $car_number_list = CarNumber::with(['car_type','last_booking.booking:id,check_in,check_out,status,code,name,phone'])
        ->orderBy('car_type_id','asc')
        ->leftJoin('car_types','car_types.id','car_numbers.car_type_id')
        ->leftJoin('booking_car_lists','booking_car_lists.car_number_id','car_numbers.id')
        ->leftJoin('bookings','bookings.id','booking_car_lists.booking_id')
        ->select(
            'car_numbers.*',
            'car_numbers.id as id',
            'car_types.name',
            'bookings.id as booking_id',
            'bookings.check_in',
            'bookings.check_out',
            'bookings.name as customer_name',
            'bookings.phone as customer_phone',
            'bookings.status as booking_status',
            'bookings.code as booking_no'
        )
        ->orderBy('car_types.id','asc')
        ->orderBy('bookings.id','desc')
        ->get();
        
        return view('backend.allcar.carlist.view_carlist',compact(('car_number_list')));

    }// End Method
}

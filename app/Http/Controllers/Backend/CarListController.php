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
use App\Models\CarType;

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

    public function AddCarList(){
        $cartype = CarType::all();
        return view('backend.allcar.carlist.add_carlist',compact('cartype'));
    }// End Method


    public function StoreCarList(Request $request)
    {
        if ($request->check_in == $request->check_out) {
            $request->flash();
            $notification = array(
                'message' => 'You Enter Same Date',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $car = Car::find($request['car_id']);
        if ($car->total_passenger < $request->number_of_person) {
            $notification = array(
                'message' => 'You Enter Maximum Number of Guest',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $book_data = Session::get('book_date');

        $toDate = Carbon::parse($request['check_in']);
        $fromDate = Carbon::parse($request['check_out']);
        $nights = $toDate->diffInDays($fromDate);

        // $car = Car::find($book_data['car_id']);

        // Get the last used code from the database
        $lastCode = Booking::orderBy('id', 'desc')->first()->code ?? 'AA000000000';

        // Extract prefix and numerical part from the last code
        preg_match('/([A-Z]{2})(\d{9})/', $lastCode, $matches);
        $prefix = $matches[1];
        $numPart = intval($matches[2]);

        // Increment numerical part
        $numPart++;

        // If numerical part exceeds 999999999, increment prefix
        if ($numPart > 999999999) {
            $prefix++;
            $numPart = 1;
        }

        // Format numerical part with leading zeros
        $numPart = str_pad($numPart, 9, '0', STR_PAD_LEFT);

        // Concatenate prefix and numerical part
        $code = $prefix . $numPart;

        $data = new Booking();
        $data->car_id = $car->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($request['check_in']));
        $data->check_out = date('Y-m-d', strtotime($request['check_out']));
        $data->persion = $request->number_of_person;
        $data->number_of_cars = $request['number_of_cars'];
        $data->total_night = $nights;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->nationality = $request->nationality;
        $data->pick_from = $request->pick_from;
        $data->drop_to = $request->drop_to;
        $data->pick_time = $request->pick_time;
        $data->msg = $request->msg;
        $data->code = $code;
        $data->status = 0;
        $data->created_at = Carbon::now();

        $data->save();

        $sdate = date('Y-m-d', strtotime($request['check_in']));
        $edate = date('Y-m-d', strtotime($request['check_out']));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new CarBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->car_id = $car->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        Session::forget('book_date');

        $notification = array(
            'message' => 'Booking Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }







}

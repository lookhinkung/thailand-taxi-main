<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CarNumber;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Car;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\CarBookedDate;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\BookingCarList;

use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{

    public function Checkout()
    {
        if (Session::has('book_date')) {
            $book_data = Session::get('book_date');
            $car = Car::find($book_data['car_id']);

            $toDate = Carbon::parse($book_data['check_in']);
            $fromDate = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);
            $persion = $book_data['persion'];
            return view('frontend.checkout.checkout', compact('book_data', 'car', 'nights', 'persion'));
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect('/')->with($notification);
        }//end else


    }//End Method

    public function BookingStore(Request $request)
    {

        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'persion' => 'required',
            // 'number_of_cars' => 'required',

        ]);

        if ($request->available_car < $request->number_of_cars) {

            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        Session::forget('book_date');

        $data = array();
        $data['number_of_cars'] = $request->number_of_cars;
        $data['available_car'] = $request->available_car;
        $data['persion'] = $request->persion;
        $data['check_in'] = date('Y-m-d', strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d', strtotime($request->check_out));
        $data['car_id'] = $request->car_id;

        Session::put('book_date', $data);

        return redirect()->route('checkout');

    }//End Method


    public function CheckoutStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'nationality' => 'required',
            // 'check_in' => 'required',
            'pick_from' => 'required',
            'phone' => 'required',
            'drop_to' => 'required',
            'pick_time'=>'required',
        ]);

        $book_data = Session::get('book_date');

        $toDate = Carbon::parse($book_data['check_in']);
        $fromDate = Carbon::parse($book_data['check_out']);
        $nights = $toDate->diffInDays($fromDate);

        $car = Car::find($book_data['car_id']);

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
        $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
        $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));
        $data->persion = $book_data['persion'];
        $data->number_of_cars = $book_data['number_of_cars'];
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

        $sdate = date('Y-m-d', strtotime($book_data['check_in']));
        $edate = date('Y-m-d', strtotime($book_data['check_out']));
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
        return redirect('/')->with($notification);
    }


    public function BookingList()
    {

        $allData = Booking::orderBy('id', 'desc')->get();
        return view('backend.booking.booking_list', compact('allData'));

    }// End Method



    public function EditBooking($id)
    {

        $editData = Booking::with('car')->find($id);
        $editCarNo = CarNumber::find($id);
        return view('backend.booking.edit_booking', compact('editData', 'editCarNo'));

    }// End Method
    public function UpdateBookingStatus(Request $request, $id)
    {

        $booking = Booking::find($id);
        $booking->status = $request->status;
        $booking->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }   // End Method 

    
    public function UpdateBooking(Request $request, $id)
    {

        $data = Booking::find($id);
        // $data->number_of_cars = $request->number_of_cars;
        $data->check_in = date('Y-m-d',strtotime($request->check_in));
        $data->check_out = date('Y-m-d',strtotime($request->check_out));
        $data->save();

        CarBookedDate::where('booking_id',$id)->delete();

        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new CarBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->car_id = $data->car_id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }
        $notification = array(
            'message' => 'Booking Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        

    }   // End Method 



    public function AssignCar($booking_id){

        $booking = Booking::find($booking_id);
        $booking_date_array = CarBookedDate::where('booking_id',$booking_id)
        ->pluck('book_date')->toArray();

        $check_date_booking_ids = CarBookedDate::whereIn('book_date',$booking_date_array)
        ->where('car_id',$booking->car_id)->distinct()->pluck('booking_id')->toArray();

        $booking_ids = Booking::whereIn('id',$check_date_booking_ids)->pluck('id')->toArray();

        $assign_car_id = BookingCarList::whereIn('booking_id',$booking_ids)->pluck
        ('car_number_id')->toArray();

        $car_numbers = CarNumber::where('car_id',$booking->car_id)->whereNotIn('id',$assign_car_id)
        ->where('status','Active')->get();

        return view('backend.booking.assign_car',compact('booking','car_numbers'));

    }// End Method

    public function AssignCarStore($booking_id,$car_number_id){

        $booking = Booking::find($booking_id);
        $check_data = BookingCarList::where('booking_id',$booking_id)->count();

        // if ($check_data < $booking->number_of_cars) {
        if ($check_data < 1) {
            $assign_data = new BookingCarList();
            $assign_data->booking_id = $booking_id;
            $assign_data->car_id = $booking->car_id;
            $assign_data->car_number_id = $car_number_id;
            $assign_data->save();

            $notification = array(
                'message' => 'Car Assign Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
            
        }else{
            $notification = array(
                'message' => 'Car Already Assign',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        

    }// End Method

    public function AssignCarDelete($id){

        $assign_car = BookingCarList::find($id);
        $assign_car->delete();

        $notification = array(
            'message' => 'Assign Car Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function DownloadInvoice($id){

        $editData = Booking::with('car')->find($id);
        $pdf = Pdf::loadView('backend.booking.booking_invoice',compact('editData'))
        ->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method
 




}


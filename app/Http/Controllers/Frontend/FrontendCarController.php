<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\MultiImage;
use App\Models\CarBookedDate;



class FrontendCarController extends Controller
{
    public function AllFrontendCarList(){
        $cars = Car::latest()->get();
        return view("frontend.cars.all_cars", compact("cars"));
    }//End Method

    public function AboutUs(){
        return view("frontend.cars.about_us");
    }//End Method

    public function CarDetailsPage($id){
        
        $cardetails = Car::find($id);
        $multiImage = MultiImage::where('car_id',$id)->get();
        $otherCars = Car::where('id','!=' ,$id)->orderBy('id','DESC')->limit(2)->get();
        return view("frontend.cars.car_details", compact("cardetails","multiImage","otherCars"));

    }//End Method

    public function BookingSearch(Request $request){

        $request->flash();

        if($request->check_in > $request->check_out){

            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = CarBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $cars = car::withCount('car_numbers')->where('status',1)->get();

        return view('frontend.cars.search_car',compact('cars','check_date_booking_ids'));
        // $dt_array = [];
        // foreach($d_period as $period){
        //     array_push($dt_array, date('Y-m-d',strtotime($period)));
        // }

        // $check_date_booking_ids = CarBookedDate::whereIn('book_date',$dt_array)
        // ->distinct()->pluck('booking_id')->toArray();

    
        // $cars = Car::withCount('car_numbers')->where('status','1')->get();

        // return view('frontend.cars.search_car', compact('cars','check_date_booking_ids'));

    }//End Method

    public function SearchCarDetails(Request $request,$id){

        $request->flash();
        $cardetails = Car::find($id);
        $multiImage = MultiImage::where('car_id',$id)->get();
        $otherCars = Car::where('id','!=' ,$id)->orderBy('id','DESC')->limit(2)->get();
        $car_id = $id;
        return view("frontend.cars.search_car_details", compact("cardetails","multiImage","otherCars","car_id"));

    }//End Method
    public function CheckCarAvailability(Request $request){
        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = CarBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $car = Car::withCount('car_numbers')->find($request->car_id);

        $bookings = Booking::withCount('assign_cars')->whereIn('id', $check_date_booking_ids)
        ->where('car_id',$car->id)->get()->toArray();

        $total_book_car = array_sum(array_column($bookings,'assign_cars_count'));

        $av_car = @$car->car_numbers_count-$total_book_car;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);

        return response()->json(['available_car'=>$av_car,'total_nights'=>$nights]);

    }//End Method

}

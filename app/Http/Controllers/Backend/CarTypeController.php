<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarType;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Car;

class CarTypeController extends Controller
{
    public function CarTypeList(){
        
        $allData = CarType::orderBy('id','desc')->get();
        return view('backend.allcar.cartype.view_cartype',compact('allData'));

    } // End Method

    public function AddCarType(){
        
        // $allData = CarType::orderBy('id','desc')->get();
        return view('backend.allcar.cartype.add_cartype',);

    } // End Method

    public function CarTypeStore(Request $request){
        
        $cartype_id = CarType::insertGetId([
            'name'=> $request->name,
            'created_at' => Carbon::now(),
        ]);

        Car::insert([
        
            'cartype_id'=>$cartype_id,
            'name_car' => $request->name,
            

        ]);

        $notification = array(
            'message' => 'Car Type inserted Successfully',
            'alert-type' => 'success'
        );
        // return redirect()->route('car.type.list')->with($notification);
        return redirect()->route('edit.car', ['id' => $cartype_id])->with($notification);

    } // End Method



}

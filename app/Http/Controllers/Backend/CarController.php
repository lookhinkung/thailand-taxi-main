<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarType;
use App\Models\MultiImage;
use App\Models\CarNumber;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    public function EditCar($id)
    {

        $editData = Car::findOrFail($id);

        $multiimgs = MultiImage::where("car_id", $id)->get();

        $allcarNo = CarNumber::where("car_id", $id)->get();

        // dd($multiimgs,$editData);
        return view("backend.allcar.car.edit_car", compact('editData', 'multiimgs', 'allcarNo'));
        



    }//End method

    // public function AddcarType($id)
    // {//
    //     $editData = Car::findOrFail($id);
    //     $multiimgs = MultiImage::where("car_id", $id)->get();
    //     $allcarNo = CarNumber::where("car_id", $id)->get();
    //     return view("backend.allcar.cartype.add_cartype", compact('editData', 'multiimgs', 'allcarNo'));
    // }//End method




    public function UpdateCar(Request $request, $id)
    {

        $car = Car::find($id);
        // $car->cartype_id = $car->cartype_id;
        $car->total_passenger = $request->total_passenger;
        $car->car_capacity = $request->car_capacity;

        $car->name_car = $request->name_car;
        $car->short_desc = $request->short_desc;
        $car->description = $request->description;
        $car->status = 1;

        //Upload Single Image
        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 850)->save('upload/carimg/' . $name_gen);
            $car['image'] = $name_gen;

        }
        $car->save();

        //Update Multi Image
        if ($car->save()) {
            $files = $request->multi_img;
            // $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            if (!empty($files)) {
                $subimage = MultiImage::where('car_id', $id)->get()->toArray();
                MultiImage::where('car_id', $id)->delete();

            }
            if (!empty($files)) {
                foreach ($files as $file) {

                    $imgName = date('YmdHi') . $file->getClientOriginalName();

                    $file->move('upload/carimg/multi_img/', $imgName);
                    $subimage['multi_img'] = $imgName;
                    
                    $subimage = new MultiImage;
                    $subimage->car_id = $car->id;
                    $subimage->multi_img = $imgName;
                    $subimage->save();
                }
            }
        }//End if condition
        $notification = array(
            'message' => 'Car Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('car.type.list')->with($notification);



    }//End method

    public function MultiImageDelete($id)
    {

        $deletedata = MultiImage::where('id', $id)->first();

        if ($deletedata) {

            $imagePath = $deletedata->multi_img;

            // Check if the file exists before unlinking
            if (file_exists($imagePath)) {
                unlink($imagePath);
                echo "Image Unlinked Successfully";
            } else {
                echo "Image does not exist";
            }

            //Delete the record from database

            MultiImage::where("id", $id)->delete();

        }

        $notification = array(
            'message' => 'Multi Image Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//End method

    public function StoreCarNumber(Request $request, $id)
    {
        $data = new CarNumber();
        $data->car_id = $id;
        $data->car_type_id = $request->car_type_id;
        $data->car_no = $request->car_no;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Car Number Added Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);

    }//End method


    public function EditCarNumber($id)
    {

        $editcarno = CarNumber::find($id);
        return view('backend.allcar.car.edit_car_no', compact('editcarno'));


    }//End method

    public function UpdateCarNumber(Request $request, $id)
    {

        $data = CarNumber::find($id);
        $data->car_no = $request->car_no;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Car Number Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('car.type.list')->with($notification);

    }//End method

    public function DeleteCarNumber($id)
    {

        CarNumber::find($id)->delete();

        $notification = array(
            'message' => 'Car Number Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('car.type.list')->with($notification);
    }//End method



    public function DeleteCar(Request $request, $id)
    {

        $car = Car::find($id);

        if (file_exists('upload/carimg/' . $car->image) and !empty($car->image)) {
            @unlink('upload/carimg/' . $car->image);
        }

        $subimage = MultiImage::where('car_id', $car->id)->get()->toArray();
        if (!empty($subimage)) {
            foreach ($subimage as $value) {
                if (!empty($value)) {
                    @unlink('upload/carimg/multi_img' . $value['multi_img']);
                }
            }

        }

        CarType::where('id', $car->cartype_id)->delete();
        MultiImage::where('car_id', $car->id)->delete();
        CarNumber::where('car_id', $car->id)->delete();
        $car->delete();

        $notification = array(
            'message' => 'Car Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//End method


}
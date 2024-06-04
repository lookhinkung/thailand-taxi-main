<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\MultiImage;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class TeamController extends Controller
{
    public function AllTeam()
    {

        $team = Team::latest()->get();
        return view('backend.team.all_team', compact('team'));

    }//End method

    public function AddTeam()
    {

        return view('backend.team.add_team');

    }//End method

    public function StoreTeam(Request $request)
    {

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(550, 670)->save('upload/team/' . $name_gen);
        $save_url = 'upload/team/' . $name_gen;

        Team::insert([

            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Team Data inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);

    }//End method

    public function EditTeam($id)
    {

        $team = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('team'));

    }//End method


    public function UpdateTeam(Request $request)
    {

        $team_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 670)->save('upload/team/' . $name_gen);
            $save_url = 'upload/team/' . $name_gen;

            Team::findOrFail($team_id)->update([

                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now(),

            ]);
            $notification = array(
                'message' => 'Team Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.team')->with($notification);

        } else {
            Team::findOrFail($team_id)->update([

                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'created_at' => Carbon::now(),

            ]);
            $notification = array(
                'message' => 'Team Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.team')->with($notification);
        }// End else

    }//End method

    public function DeleteTeam($id)
    {

        $item = Team::findOrFail($id);
        $img = $item->image;
        unlink($img);

        Team::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Team Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//End method


    // ========================================= Book Area All Method================================

    public function BookArea()
    {

        $book = BookArea::find(1);
        return view('backend.bookarea.book_area', compact('book'));

    }//End method

    public function BookAreaUpdate(Request $request){

        

        $book_id = $request->id;

        if($request->file('image')){

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1000,1000)->save('upload/bookarea/'.$name_gen);
            $save_url = 'upload/bookarea/'.$name_gen;

            BookArea::findOrFail($book_id)->update([

                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'image' => $save_url, 
            ]);

            $notification = array(
                'message' => 'Book Area Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);


        } else {

            BookArea::findOrFail($book_id)->update([

                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url, 
            ]);

            $notification = array(
                'message' => 'Book Area Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } // End Eles 

        


    } // End Method 

    
        
        



}

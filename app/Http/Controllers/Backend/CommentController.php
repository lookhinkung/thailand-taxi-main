<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function StoreComment(Request $request){

        Comment::insert([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'message' => $request->message,
            
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Comment Added Successfully Admin will approved',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method

    public function AllComment(){

        $allcomment = Comment::latest()->get();
        return view('backend.comment.all_comment',compact('allcomment'));

    }//End Method

    public function UpdateCommentStatus(Request $request){

        $commentId = $request->input('comment_id');
        $isChecked = $request->input('is_checked',0);

        $comment = Comment::find($commentId);
        if ($comment) {
            $comment->status = $isChecked;
            $comment->save();
        }

        return response()->json(['message'=> 'Comment Status Updates Successfully']);

    }//End Method


    public function ContactUs(){

        return view('frontend.contact.contact_us');

    }//End Method

    public function StoreContact(Request $request){

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Your Message Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method

    public function AdminContactMessage(){

        $contact = Contact::latest()->get();
        return view('backend.contact.contact_message',compact('contact'));

    }//End Method



}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function Blogcategory()
    {
        $category = BlogCategory::latest()->get();
        return view('backend.category.blog_category', compact('category'));
    }//End Method

    public function StoreBlogCategory(Request $request)
    {
        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);
        $notification = array(
            'message' => 'Blog Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method
    public function UpdateBlogCategory(Request $request)
    {

        $cat_id = $request->cat_id;

        BlogCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);
        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method

    public function EditBlogCategory($id)
    {
        $categories = BlogCategory::find($id);
        return response()->json($categories);
    }//End Method


    public function DeleteBlogCategory($id)
    {
        Blogcategory::find($id)->delete();
        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//End Method


    /////////////////////////// All Blog Post Method //////////////////////
    public function AllBlogPost()
    {
        $post = BlogPost::latest()->get();
        return view('backend.post.all_post', compact('post'));
    }//End Method

    public function AddBlogPost()
    {
        $blogcat = BlogCategory::latest()->get();
        return view('backend.post.add_post', compact('blogcat'));
    }//End Method

    public function StoreBlogPost(Request $request)
    {

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(550, 370)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        BlogPost::insert([

            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'note' => $request->note,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'BlogPost Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);

    } // End Method 

    public function EditBlogPost($id)
    {
        $blogcat = BlogCategory::latest()->get();
        $post = Blogpost::find($id);
        return view('backend.post.edit_post', compact('blogcat', 'post'));

    }

    public function UpdateBlogPost(Request $request)
    {

        $post_id = $request->id;

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 370)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;

            BlogPost::findOrFail($post_id)->update([

                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'note' => $request->note,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),

            ]);
            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.post')->with($notification);

        } else {
            BlogPost::findOrFail($post_id)->update([

                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'note' => $request->note,
                'created_at' => Carbon::now(),

            ]);
            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.post')->with($notification);
        }// End else

    }//End method
    public function DeleteBlogPost($id)
    {

        $item = BlogPost::findOrFail($id);
        $img = $item->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//End method

    public function BlogDetails($slug){
        
        $blog = BlogPost::where('post_slug',$slug)->first();
        $bcategory = Blogcategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_details',compact('blog','bcategory','lpost'));


    }//End method

    public function BlogCatList($id){
        
        $blog = BlogPost::where('blogcat_id',$id)->get();
        $namecat = Blogcategory::where('id',$id)->first();
        $bcategory = Blogcategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_cat_list',compact('blog','bcategory','lpost','namecat'));


    }//End method

    public function BlogList(){

        $blog = BlogPost::latest()->paginate(3);
        $bcategory = BlogCategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_all',compact('blog','bcategory','lpost'));


     }// End Method 


}

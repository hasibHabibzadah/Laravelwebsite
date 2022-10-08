<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Image;

// use Intervention\Image\Facades\Image;
use PhpParser\Parser\Multiple;

class AboutController extends Controller
{
    //


    public function aboutPage()
    {
        $about = About::find(1);
        return view('admin.about_page.about_page_all', compact('about'));
    }

    public function homeAbout()
    {

        $about = About::find(1);
        return view('frontend.about_page', compact('about'));
    } // End Method 

    public function updateAbout(Request $request)
    {
        $about_id = $request->id;
        // dd($request->title,$request->short_title, $request->video_url);
        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            // Image::make($image)->resize(523,605)->save('upload/home_about/'.$name_gen);
            $save_url = 'upload/home_about/' . $name_gen;
            // $image->move(public_path('upload/home_slide'),$image);
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'short_title' => $request->long_description,
                'about_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'about Page Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'short_title' => $request->long_description,

            ]);
            $notification = array(
                'message' => 'About Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }


    public function AboutMultiImage(){
        return view('admin.about_page.multiImage');
    }


    public function storeMultiImage(Request $request){

        $multi_image = $request->file('multi_image');
        foreach($multi_image as $image){
            
            
            $name_gen = hexdec(uniqid(). '.'.$image->getClientOriginalExtension());

            
            Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen.'.jpg');

            $save_url = 'upload/multi/'.$name_gen.'.jpg';
            
            MultiImage::insert([
                'multi_image' => $save_url,
                'created_at' => carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Multiple image Updated with Image successfuly',
            'alert-type' => 'success',
        );
            return redirect()->back()->with($notification);
        
    }// End Methooddd


    public function allMultiImage(){
        $allMultiImage = MultiImage::all();
        return view("admin.about_page.all_multiImage",compact('allMultiImage'));
    }

    public function editMultiImage($id){
        $MultiImage = MultiImage::findOrFail($id);

        return view('admin.about_page.edit_multi_image',compact('MultiImage'));

    }

    public function updateMultiImage(Request $request){
        $multi_image_id = $request->id;
     

        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

             Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen.'.jpg');
            $save_url = 'upload/multi/'.$name_gen.'.jpg';

            MultiImage::findOrFail($multi_image_id)->update([

                'multi_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Multi Image Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.multi.image')->with($notification);

        }
    } // End METHOD ****** * *** ** * * * ** * * * * * *

    public function deleteMultiImage($id){
        $multi = MultiImage::findOrfail($id);
        
        $img = $multi->multi_image;
        unlink($img);

        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Multi Image deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method
}

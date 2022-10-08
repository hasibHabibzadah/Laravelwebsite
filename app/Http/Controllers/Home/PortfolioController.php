<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Image;
use Illuminate\Support\Carbon;

class PortfolioController extends Controller
{

    public function homePortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('frontend.portfolio',compact('portfolio'));
    }
    //
    public function AllPortfolio()
    {
        // get all the latest data in portfolio  
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    } // End Method 


    public function addPortfolio()
    {

        return view("admin.portfolio.portfolio_add");
    }
    public function storePortfolio(Request $request)
    {

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ], [
            'portfolio_name' => 'Portfolio name is required',
            'portfolio_title' => 'Portfolio tile is required',

        ]);

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

        Image::make($image)->resize(1020, 519)->save('upload/portfolio/' . $name_gen);
        $save_url = 'upload/portfolio/' . $name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function editPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function updatePortfolio(Request $request)
    {
        $portfolio_id = $request->id;

        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(1020, 519)->save('upload/portfolio/' . $name_gen);
            $save_url = 'upload/portfolio/' . $name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Portfolio Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);
        } else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,


            ]);
            $notification = array(
                'message' => 'Portfolio Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function deletePortfolio($id){
        $id_to_delete = Portfolio::findOrFail($id);
        $img = $id_to_delete->portfolio_image;
        unlink($img);
         Portfolio::findOrFail($id)->delete();
         $notification = array(
            'message' => 'Portfolio deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function detailsPortfolio($id){
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));
    }
}

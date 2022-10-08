<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification =  array(
            'message' => 'You successfully logged out',
            'alert-type' => 'success'
        ); 
        return redirect('/login')->with($notification);
    }

    public function profile(){
        /* First get the use details for extra use;
            ** it will return a number that is the primary
            *** key of the user table 
        */
        $id = Auth::user()->id; 

        $adminData = User::find($id);
        // dd($adminData);
        return view('admin.admin_profile_view')->with('adminData',$adminData);

    }// End Method


    public function editProfile(){
        $id = Auth::user()->id; 

        $edit = User::find($id);
        return view('admin.admin_profile_edit')->with('edit',$edit);
    }//! END


    public function StoreProfile(Request $request){
        $id = Auth::user()->id; 

        $data = User::find($id);
        
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$fileName);
            $data['profile_image'] = $fileName;
        }
        $data->save();
        $notification =  array(
            'message' => 'Admin Profile Updated successfully',
            'alert-type' => 'info',

        ); 
        return redirect()->route('admin.profile')->with($notification);

    }// End method

    public function  ChangePassword(){


        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $hashed_password = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashed_password)){
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newpassword);
            $user->save();
            
            session()->flash('message','Password successfully Updated');

            return redirect()->back();
        }else{
            session()->flash('message','Old password does not match');

            return redirect()->back();
        }
    }
}

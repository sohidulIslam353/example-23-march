<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //admin after login
    public function admin()
    {
        return view('admin.home');
    }

    //admin custome logout
    public function logout()
    {
    	Auth::logout();
    	$notification=array('messege' => 'You are logged out!', 'alert-type' => 'success');
    	return redirect()->route('admin.login')->with($notification);
    }

    //password change page
    public function PasswordChange(){
        return view('admin.profile.password_change');
    }

    //password Update
    public function PasswordUpdate(Request $request)
    {
        $validated = $request->validate([
           'old_password' => 'required',
           'password' => 'required|min:6|confirmed',
        ]);

        $current_password=Auth::user()->password;  //login user password get


        $oldpass=$request->old_password;  //oldpassword get from input field
        $new_password=$request->password;  // newpassword get for new password
        if (Hash::check($oldpass,$current_password)) {  //checking oldpassword and currentuser password same or not
               $user=User::findorfail(Auth::id());    //current user data get
               $user->password=Hash::make($request->password); //current user password hasing
               $user->save();  //finally save the password
               Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
               $notification=array('messege' => 'Your Password Changed!', 'alert-type' => 'success');
               return redirect()->route('admin.login')->with($notification);
        }else{
            $notification=array('messege' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

}

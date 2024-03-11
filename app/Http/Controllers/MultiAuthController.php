<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MultiAuthController extends Controller
{
    //login page
    public function index(){
        if(Auth::check()){
           if(Auth::user()->role=='1'){
            return redirect()->route('admin.dashboard');
           }else{
            return redirect()->route('user.dashboard');
           }

        } else{
            return view('auth.login');
        }

    }//end method


    //post login
    public function postLogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            if(Auth::user()->role=='1'){
                return redirect()->route('admin.dashboard');
            } else{
                return redirect()->route('user.dashboard');
            }
        } else{
            return back()->with('sms','The credentials do not match our records.');
        }
    }//end method


    //admin dashboard
    public function adminDashboard(){
        return view('auth.dashboard');
    }//end method


    //user dashboard
    public function userDashboard(){
        return view('auth.dashboard');
    }//end method


    //logout
    public function logout(){
        Session::flush();
        return redirect('/');
    }//end method
}

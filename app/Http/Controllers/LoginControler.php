<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;
class loginControler extends Controller
{
    public function getLogin(){
        return view('auth.login');
    }
    public function postLogin(request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ],[
            'email.required'=>'email khong duoc de trong',
            'email.email'=>'email khong dung dinh dang',
            'password.required'=>'mat khau khong duoc de trong'
        ]);
        $email=$request->email;
        $password=$request->password;
       
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            Session::put('useremail',Auth::user()->email);
            Session::put('username',Auth::user()->name);
            return redirect('/admin/tinh');
        }
        return redirect('/login');
    }
    public function getLogout(){
         Session::forget('useremail');
         Session::forget('username');
         Auth::logout();
         return redirect('/');
    }
}

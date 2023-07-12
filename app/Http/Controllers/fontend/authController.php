<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Validator,Redirect,Response;


class authController extends Controller
{
    public function index()
    {
        return view('fontend.login');
    }

    public function register()
    {
        return view('fontend.register');
    }

    public function create(array $data)
    {
        User::create([

            'name'=>$data['name'],
            'email' =>$data['email'],
            'password' =>Hash::make($date['password']),

        ]);
    }

    public function post_register(Request $request)
    {
        request()->validate([

            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',

        ]);

        $user = User::create([

        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('fontend.register')->with('status',"Register Successfully");
    }

    public function post_login(Request $request)
    {
        request()->validate([
            'email'=> 'required',
            'password'=>'required|min:6',
        ]);

        $cridasial = $request->only('email','password');

        if(Auth::attempt($cridasial))
        {
            return Redirect::to('dashboard');
        }
        else
        {
            return Redirect::to('login')->with('status','Your Email Or Password Unvalid');
        }
    }

    public function dashboard()
    {
      if(Auth::check()) 
      {
        return view('dashboard');
      } 

      return Redirect::to('login');
    }

    public function logout()
    {
        Session::flash();
        Auth::logout();
        return Redirect::to('/')->with('status','Logout Successfully');
    }
}

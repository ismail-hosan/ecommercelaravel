<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function deshboard()
    {
        return view('admin.deshboard');
    }

    public function category()
    {
        return view('admin.category');
    }

    public function auth(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];

        $result = Admin::where(['email'=>$email,'password'=>$password])->get();

        if(isset($result['0']->id))
        {
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_ID',$result['0']->id);
            return redirect('admin/deshboard');
        }
        else
        {
            $request->session()->flash('error','Please Enter The Valid Password');
            return redirect('/admin');
        }
    }

    public function logout()
    {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        return redirect('/admin');
    }
}

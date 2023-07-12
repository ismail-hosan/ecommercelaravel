<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class fontendController extends Controller
{
    public function index()
    {
        return view('fontend.index');
    }

    public function login()
    {
        return view('fontend.login');
    }

    public function shop()
    {
        return view('fontend.shop');
    }

    public function ditails()
    {
        return view('fontend.ditails');
    }
}

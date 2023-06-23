<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if(Auth::user()->role === ('admin'))
        {
            return redirect()->route('admin-dashboard');
        }else
        {
            return view('citizens.index');
        }


//        if(Auth::user()->hasRole('admin'))
//        {
//            return redirect()->route('admin-dashboard');
//        }elseif(Auth::user()->hasRole('user'))
//        {
//            return redirect()->route('user-dashboard');
//        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home(){
        $settings = Setting::first();
        return view('home', compact('settings'));
    }
}

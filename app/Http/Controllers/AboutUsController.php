<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //
    public function about()
{
    $settings = Setting::first();
    return view('about', compact('settings'));
}

}

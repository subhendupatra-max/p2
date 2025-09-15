<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;


class HomeController extends Controller
{

    public function home(){
        $title = 'Home';
        return view('frontend.index',compact('title'));
    }
}

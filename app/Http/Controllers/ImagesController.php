<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getimages(){
        return view('dashboard.images');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getarticles(){
        return \App\Models\Article::with('Images')->get();
    }
}

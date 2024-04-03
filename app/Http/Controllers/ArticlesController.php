<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function getarticles(){
        return \App\Models\Article::with('Images')->get();
    }

    public function searchResults(Request $request)
    {
        $query = $request->get('q');
        $articles = Article::where('title', 'like', '%'.$query.'%')->with('category')->paginate(10);

        if(auth()->check()){
            return view('elements.search-results', ['articles' => $articles]);
        } else {
            return view('elements.search-results-guest', ['articles' => $articles]);
        }
    }
}

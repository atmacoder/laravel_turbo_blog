<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        $categories = \App\Models\Category::all();
        $articles = \App\Models\Article::where('category_id',1)->get();
        return view('main', compact('articles','categories'));
    }
    public function articles(Request $request)
    {
        $category_id = 1;
        if($request->category_id){
            $category_id = $request->category_id;
        }
        return view('main.articles.articles', compact('category_id'));
    }
    public function category($cat)
    {
        $category = \App\Models\Category::where('slug', $cat)->first();

        if (!$category) {
            // Обработка случая, когда категория не найдена
            return response()->view('errors.404', [], 404);
        }

        $articles = \App\Models\Article::where('category_id', $category->id)->get();
        $categories = \App\Models\Category::all();

        return view('main.articles.articles', compact('articles', 'categories', 'category'));
    }
    public function article($article_slug,$category_slug)
    {
        return view('main.articles.article', compact('article_slug', 'category_slug'));
    }
    public function article_full($category_slug,$article_slug)
    {
        $categories = \App\Models\Category::all();
        $article = \App\Models\Article::where('slug',$article_slug)->first();
        return view('main.articles.article-full', compact('article_slug', 'category_slug', 'article','categories'));
    }
}

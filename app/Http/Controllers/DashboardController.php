<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }
    public function articles()
    {
        return view('dashboard.articles');
    }
    public function roles()
    {
        return view('dashboard.roles');
    }
    public function сategories()
    {
        return view('dashboard.сategories');
    }
    public function add_article()
    {
        return view('dashboard.add_article');
    }
    public function add_role()
    {
        return view('dashboard.add_role');
    }
    public function add_category()
    {
        return view('dashboard.add_category');
    }
    public function editArticle(Request $request)
    {

        return view('dashboard.article_edit');
    }
    public function editCategory(Request $request)
    {

        return view('dashboard.category_edit');
    }
}

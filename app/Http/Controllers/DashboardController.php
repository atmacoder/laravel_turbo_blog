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
        return view('dashboard.articles.articles');
    }
    public function add_article()
    {
        return view('dashboard.articles.add_article');
    }
    public function editArticle(Request $request)
    {

        return view('dashboard.articles.article_edit');
    }
    public function users()
    {
        return view('dashboard.users.users');
    }
    public function add_user()
    {
        return view('dashboard.users.add_user');
    }
    public function edit_user()
    {
        return view('dashboard.users.edit_user');
    }
    public function roles()
    {
        return view('dashboard.roles.roles');
    }
    public function сategories()
    {
        return view('dashboard.Categories.сategories');
    }

    public function editCategory(Request $request)
    {

        return view('dashboard.categories.category_edit');
    }
    public function add_category()
    {
        return view('dashboard.categories.add_category');
    }
    public function add_role()
    {
        return view('dashboard.roles.add_role');
    }
    public function permissions()
    {
        return view('dashboard.permissions.permissions');
    }
    public function add_permission()
    {
        return view('dashboard.permissions.add_permission');
    }

    public function editRole(Request $request)
    {

        return view('dashboard.roles.edit_role');
    }
}

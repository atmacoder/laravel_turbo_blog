<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  \App\Models\Settings;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function main()
    {
        return view('index');
    }
    public function dashboard()
    {
        $settings = Settings::first();

        return view('dashboard.index');
    }
    public function articles()
    {
        return view('dashboard.articles.articles');
    }
    public function metaArticles()
    {
        return view('dashboard.articles.articles-metadatas');
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
    public function user_api()
    {
        return view('dashboard.users.user_api_token');
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
        return view('dashboard.categories.сategories');
    }

    public function editCategory(Request $request)
    {

        return view('dashboard.categories.category_edit');
    }
    public function add_category()
    {
        return view('dashboard.categories.add_category');
    }
    public function add_comment()
    {
        return view('dashboard.comments.add_comment');
    }
    public function comments()
    {
        return view('dashboard.comments.comment_list');
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
    public function no_permissions()
    {
        return view('dashboard.permissions.noPermission');
    }

    public function editRole(Request $request)
    {

        return view('dashboard.roles.edit_role');
    }
    public function extendArticleAdd()
    {

        return view('dashboard.articles.extend-article-add');
    }
    public function extendArticleEdit()
    {

        return view('dashboard.articles.extend-article-edit');
    }
    public function extendArticleList()
    {

        return view('dashboard.articles.extend-article-list');
    }

    public function siteSettings()
    {

        return view('dashboard.site_settings');
    }
}

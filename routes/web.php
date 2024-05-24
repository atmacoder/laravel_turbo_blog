<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\MainController::class, 'main'])->name('main');

Route::get('/sitemap.xml',  [App\Http\Controllers\SitemapController::class, 'generate_sitemap_index'])->name('generate_sitemap_index');
Route::get('/sitemap/generate',  [App\Http\Controllers\SitemapController::class, 'generate_sitemap'])->name('generate_sitemap');

Route::get('/404', function () {
    return view('errors.404');
})->name('404');

Route::get('/articles', [App\Http\Controllers\MainController::class, 'articles'])->name('articles');

Route::get('/{category}/{article}', [App\Http\Controllers\MainController::class, 'article_full'])->name('article-full');


Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/add-article', [App\Http\Controllers\DashboardController::class, 'add_article'])->name('add-article');
Route::get('/dashboard-articles', [App\Http\Controllers\DashboardController::class, 'articles'])->name('dashboard-articles');

Route::get('/article-edit', [App\Http\Controllers\DashboardController::class, 'editArticle'])->name('article_edit');
Route::get('/getarticles', [App\Http\Controllers\ArticlesController::class, 'getarticles'])->name('getarticles');
Route::get('/articles-meta', [App\Http\Controllers\DashboardController::class, 'metaArticles'])->name('articles_meta');

Route::get('/extend-article-add', [App\Http\Controllers\DashboardController::class, 'extendArticleAdd'])->name('extend_article_add');
Route::get('/extend-article-edit', [App\Http\Controllers\DashboardController::class, 'extendArticleEdit'])->name('extend_article_edit');
Route::get('/extend-article-list', [App\Http\Controllers\DashboardController::class, 'extendArticleList'])->name('extend_article_list');

Route::get('/gallery', [App\Http\Controllers\ImagesController::class, 'getimages'])->name('getimages');

Route::get('/add-comment', [App\Http\Controllers\DashboardController::class, 'add_comment'])->name('add-comment');
Route::get('/comments', [App\Http\Controllers\DashboardController::class, 'comments'])->name('comments');

Route::get('/add-сategory', [App\Http\Controllers\DashboardController::class, 'add_category'])->name('add-category');
Route::get('/сategories', [App\Http\Controllers\DashboardController::class, 'сategories'])->name('сategories');
Route::post('/category_add', [App\Http\Controllers\CategoriesController::class, 'category_add'])->name('category_add');
Route::get('/category-edit', [App\Http\Controllers\DashboardController::class, 'editCategory'])->name('category_edit');

Route::get('/roles', [App\Http\Controllers\DashboardController::class, 'roles'])->name('roles');
Route::get('/role-edit', [App\Http\Controllers\DashboardController::class, 'editRole'])->name('role_edit');
Route::get('/add-role', [App\Http\Controllers\DashboardController::class, 'add_role'])->name('add-role');
Route::get('/add-permission', [App\Http\Controllers\DashboardController::class, 'add_permission'])->name('add-permission');
Route::get('/permissions', [App\Http\Controllers\DashboardController::class, 'permissions'])->name('permissions');
Route::get('/no-permission', [App\Http\Controllers\DashboardController::class, 'no_permissions'])->name('no-permissions');

Route::get('/users', [App\Http\Controllers\DashboardController::class, 'users'])->name('users');
Route::get('/add-user', [App\Http\Controllers\DashboardController::class, 'add_user'])->name('add_user');
Route::get('/edit-user', [App\Http\Controllers\DashboardController::class, 'edit_user'])->name('edit_user');
Route::get('/user-api', [App\Http\Controllers\DashboardController::class, 'user_api'])->name('user_api');

Route::post('dashboard-images', [App\Http\Controllers\FileUploadController::class, 'dashboard_images' ])->name('dashboard_images');

Route::get('/settings', [App\Http\Controllers\DashboardController::class, 'siteSettings'])->name('siteSettings');
Route::get('/menu', [App\Http\Controllers\DashboardController::class, 'siteMenuBuilder'])->name('siteMenuBuilder');
Route::get('/search-results', [App\Http\Controllers\ArticlesController::class, 'searchResults'])->name('searchResults');

Route::get('/{category}', [App\Http\Controllers\MainController::class, 'category'])->name('category');

Route::fallback(function () {
    return view('errors.404');
});

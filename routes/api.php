<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/upload_img', [App\Http\Controllers\Api\UploadController::class, 'uploadImg'])->name('uploadImg');
    Route::post('/upload_content', [App\Http\Controllers\Api\UploadController::class, 'uploadContent'])->name('uploadContent');
});

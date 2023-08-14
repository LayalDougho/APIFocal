<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh');
});
/////////////////////////////////////////////

//Category Routes

Route::get('categories',[CategoryController::class,'index'])->middleware('auth:api');
Route::get('categories/check/name',[CategoryController::class,'checkName'])->middleware('auth:api');
Route::get('categories/store',[CategoryController::class,'store'])->middleware('auth:api');
Route::get('categories/{id}/show',[CategoryController::class,'show'])->middleware('auth:api');
Route::get('categories/check/edit/name',[CategoryController::class,'checkEditName'])->middleware('auth:api');
Route::get('categories/update',[CategoryController::class,'update'])->middleware('auth:api');
Route::get('categories/destroy',[CategoryController::class,'destroy'])->middleware('auth:api');


//Post Routes

Route::get('post',[PostController::class,'index'])->middleware('auth:api');
Route::post('post/check/title',[PostController::class,'checkTitle'])->middleware('auth:api');
Route::post('post/check/category',[PostController::class,'checkCategory'])->middleware('auth:api');
Route::post('post/check/content',[PostController::class,'checkcontent'])->middleware('auth:api');
Route::post('post/store',[PostController::class,'store'])->middleware('auth:api');
Route::get('post/{id}/show',[PostController::class,'show']);
Route::post('post/update',[PostController::class,'update'])->middleware('auth:api');
Route::post('post/destroy',[PostController::class,'destroy'])->middleware('auth:api');
Route::get('post/{id}/tag',[PostController::class,'tag']);

//Tag Routes

Route::get('tag',[CommentController::class,'index'])->middleware('auth:api');
Route::post('tag/check/tag',[CommentController::class,'checkTag'])->middleware('auth:api');
Route::post('tag/check/post',[CommentController::class,'checkPost'])->middleware('auth:api');
Route::post('tag/store',[CommentController::class,'store'])->middleware('auth:api');
Route::get('tag/{id}/show',[CommentController::class,'show']);
Route::post('tag/{id}/update',[CommentController::class,'update'])->middleware('auth:api');
Route::post('tag/{id}/destroy',[CommentController::class,'destroy'])->middleware('auth:api');



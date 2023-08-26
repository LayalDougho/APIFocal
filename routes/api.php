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

Route::prefix('user')->middleware('auth')->group(function(){
    
//Category Routes

    Route::get('categories',[CategoryController::class,'index'])->middleware('is_admin');
    Route::get('categories/check/name',[CategoryController::class,'checkName'])->middleware('is_admin');
    Route::get('categories/store',[CategoryController::class,'store'])->middleware('is_admin');
    Route::get('categories/{id}/show',[CategoryController::class,'show'])->middleware('is_admin');
    Route::get('categories/check/edit/name',[CategoryController::class,'checkEditName'])->middleware('is_admin');
    Route::get('categories/update',[CategoryController::class,'update'])->middleware('is_admin');
    Route::get('categories/destroy',[CategoryController::class,'destroy'])->middleware('is_admin');


    //Post Routes

    Route::get('post',[PostController::class,'index'])->middleware('check_user');
    Route::post('post/check/title',[PostController::class,'checkTitle'])->middleware('check_user');
    Route::post('post/check/category',[PostController::class,'checkCategory'])->middleware('check_user');
    Route::post('post/check/content',[PostController::class,'checkcontent'])->middleware('check_user');
    Route::post('post/store',[PostController::class,'store'])->middleware('check_user');
    Route::get('post/{id}/show',[PostController::class,'show'])->middleware('check_user');
    Route::post('post/update',[PostController::class,'update'])->middleware('check_user');
    Route::post('post/destroy',[PostController::class,'destroy'])->middleware('check_user');
    Route::get('post/{id}/tag',[PostController::class,'tag'])->middleware('check_user');

    
//Tag Routes

    Route::get('tag',[CommentController::class,'index'])->middleware('is_admin');
    Route::post('tag/check/tag',[CommentController::class,'checkTag'])->middleware('check_user');
    Route::post('tag/check/post',[CommentController::class,'checkPost'])->middleware('is_admin');
    Route::post('tag/store',[CommentController::class,'store'])->middleware('check_user');
    Route::get('tag/{id}/show',[CommentController::class,'show'])->middleware('check_user');
    Route::post('tag/{id}/update',[CommentController::class,'update'])->middleware('check_user');
    Route::post('tag/{id}/destroy',[CommentController::class,'destroy'])->middleware('is_admin');


});





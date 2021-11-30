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

Route::post("/User/login","API\V1\UserController@login");
Route::get("/User/logout","API\V1\UserController@logout");

Route::post("/User/register","API\V1\UserController@register");
Route::middleware('auth:api')->group(function () {

  Route::get("/Categories/index","API\V1\CategoryController@index");



  Route::get("/News/index","API\V1\NewsController@index");
  Route::post("/News/store","API\V1\NewsController@store");
  Route::get("/News/show/{id}","API\V1\NewsController@show");
  Route::put("/News/update/{id}","API\V1\NewsController@update");
  Route::delete('/News/delete/{id}',"API\V1\NewsController@destroy");



  Route::post("/Comment/store","API\V1\CommentController@store");
  Route::get("/Comment/show/{id}","API\V1\CommentController@show");
  Route::put("/Comment/update/{id}","API\V1\CommentController@update");
  Route::delete('/Comment/delete/{id}',"API\V1\CommentController@destroy");



});

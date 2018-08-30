<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('users','UsersController@index');
Route::get('users/{id}','UsersController@show');
Route::post('users','UsersController@store');
Route::put('users/{user}','UsersController@update');
Route::delete('users/{user}','UsersController@delete');
Route::post('login', 'UsersController@login');
Route::any('errors','UsersController@errors');

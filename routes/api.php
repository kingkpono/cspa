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

//sector
Route::get('sectors','SectorController@index');
Route::get('sectors/{id}','SectorController@show');
Route::post('sectors','SectorController@store');
Route::put('sectors/{sector}','SectorController@update');
Route::delete('sectors/{sector}','SectorController@delete');

//client
Route::get('clients','ClientController@index');
Route::get('clients/{id}','ClientController@show');
Route::post('clients','ClientController@store');
Route::put('clients/{client}','ClientController@update');
Route::delete('clients/{client}','ClientController@delete');


//bdm_persons
Route::get('bdmpersons','BdmPersonController@index');
Route::get('bdmpersons/{id}','BdmPersonController@show');
Route::post('bdmpersons','BdmPersonController@store');
Route::put('bdmpersons/{bdmperson}','BdmPersonController@update');
Route::delete('bdmpersons/{bdmperson}','BdmPersonController@delete');

//client
Route::get('prospects','ClientController@prospects');
Route::get('prospects/{id}','ClientController@showProspect');
Route::put('prospects/{prospect}','ClientController@update');
Route::delete('prospects/{prospect}','ClientController@delete');


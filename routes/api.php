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
Route::post('users/officers','UsersController@getProjectOfficers');


//sector
Route::get('sectors','SectorController@index');
Route::get('sectors/{id}','SectorController@show');
Route::post('sectors','SectorController@store');
Route::put('sectors/{sector}','SectorController@update');
Route::delete('sectors/{sector}','SectorController@delete');

//client

Route::get('clients','ClientController@index');
Route::get('clients/bdm/{id}','ClientController@getClientsByBdmId');
Route::get('clients/sector/{id}','ClientController@getClientsBySectorId');
Route::get('clients/by-type-and-sector/{type}/{id}','ClientController@getClientsByTypeAndSector');
Route::get('clients/{id}','ClientController@show');
Route::post('clients','ClientController@store');
Route::get('clients/type/{type}','ClientController@getClientsByType');
Route::put('clients/{client}','ClientController@update');
Route::delete('clients/{client}','ClientController@delete');


//bdm_persons
Route::get('bdmpersons','BdmPersonController@index');
Route::get('bdmpersons/{id}','BdmPersonController@show');
Route::post('bdmpersons','BdmPersonController@store');
Route::put('bdmpersons/{bdmperson}','BdmPersonController@update');
Route::delete('bdmpersons/{bdmperson}','BdmPersonController@delete');


//devices
Route::get('devices','DeviceController@index');
Route::get('devices/{id}','DeviceController@show');
Route::post('devices','DeviceController@store');
Route::put('devices/{device}','DeviceController@update');
Route::delete('devices/{device}','DeviceController@delete');

//service types
Route::get('serviceTypes','ServiceTypeController@index');
Route::get('serviceTypes/{id}','ServiceTypeController@show');
Route::post('serviceTypes','ServiceTypeController@store');
Route::put('serviceTypes/{serviceType}','ServiceTypeController@update');
Route::delete('serviceTypes/{serviceType}','ServiceTypeController@delete');


//sales tickets
Route::get('salesTickets','SalesTicketController@index');
Route::get('salesTickets/{id}','SalesTicketController@show');
Route::post('salesTickets','SalesTicketController@store');
Route::put('salesTickets/{SalesTicket}','SalesTicketController@update');
Route::delete('salesTickets/{SalesTicket}','SalesTicketController@delete');

//support tickets
Route::get('supportTickets','SupportTicketController@index');
Route::get('supportTickets/{id}','SupportTicketController@show');
Route::post('supportTickets','SupportTicketController@store');
Route::put('supportTickets/{SupportTicket}','SupportTicketController@update');
Route::delete('supportTickets/{id}','SupportTicketController@delete');





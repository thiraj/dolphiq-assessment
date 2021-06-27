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

Route::group(['middleware' => ['cors', 'auth:api'], 'namespace' => 'v1', 'prefix' => 'v1'], function (){
    Route::post('/customer', 'CustomerController@storeCustomer');
    Route::put('/customer', 'CustomerController@updateCustomer');
    Route::delete('/customer', 'CustomerController@deleteCustomer');
    Route::get('/customers/filter', 'CustomerController@filterCustomers');
    Route::post('/customers/import', 'CustomerController@importCustomers');
    Route::get('/oauth/logout', 'AuthController@logOut');
});

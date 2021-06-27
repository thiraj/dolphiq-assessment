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

Route::get('/', function () {
    return 'Welcome, but we are provide only a REST API. Please read our API documentation on Postman. Visit our API <a href="https://bit.ly/3jbUcUm" target="_blank">documentation</a>';
});

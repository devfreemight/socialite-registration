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

Route::get('/brandiology-admin/{vue?}', "App\AdminAppController@index")
    ->where('vue', '[\/\w\W\.-]*');
Route::get('/{vue?}', "App\GuestAppController@index")->where('vue', '[\/\w\W\.-]*');

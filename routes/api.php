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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api'], function () {
    Route::get('/cities', 'CitiesController@index');
    Route::get('/barangay', 'BarangayController@getList');
    Route::apiResource('/guest', 'GuestController');
    Route::apiResource('/registrants', 'RegistrantController')->middleware(['auth:api']);
    Route::post('/registrants/export-csv', 'RegistrantController@exportCSV')->middleware(['auth:api']);
});

Route::group(['prefix' => 'user', 'namespace' => 'Auth'], function() {
    Route::post('/login', 'LoginController@login')->middleware('guest');

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/check-token', 'LoginController@checkToken');
        Route::post('/logout', 'LoginController@logout');
    });
});

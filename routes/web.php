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

// Route::get('/{vue?}', \App\Http\Controllers\App\EmployeeAppController::class)->where('vue', '[\/\w\W\.-]*');


// Route::get('/admin/{vue?}', function () {
//     return view('app.admin');
// })->where('vue', '[\/\w\W\.-]*');

Route::get('/brandiology-admin/{vue?}', "App\AdminAppController@index")->where('vue', '[\/\w\W\.-]*');
Route::get('/{vue?}', "App\GuestAppController@index")->where('vue', '[\/\w\W\.-]*');

// Route::redirect('/', '/select-city');
// Route::get('/select-city', 'CitySelectionController@index');zaAA
// Route::get('/user/registration/{city_id}', 'UserRegistrationController@showRegistrationForm')->name('user.registration');

// // Route::post('/user/registration', 'UserRegistrationController@showRegistrationForm')->name('user.registration');
// // Route::get('/user/registration', 'UserRegistrationController@setRegistrationForm');

// // Route::get('/socialite/redirect/{provider}/{city?}', 'SocialRegistrationController@redirectProvider');
// // Route::get('/socialite/callback/{provider}', 'SocialRegistrationController@registerWithProvider');

// Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');

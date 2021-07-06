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

Route::redirect('/', '/select-city');
Route::get('/select-city', 'CitySelectionController@index');
Route::post('/user/registration', 'UserRegistrationController@showRegistrationForm')->name('user.registration');
Route::get('/user/registration', 'UserRegistrationController@setRegistrationForm');
Route::view('/users/registration-notice', 'registration.notice');

Route::get('/socialite/redirect/{provider}/{city}', 'SocialRegistrationController@redirectProvider');
Route::get('/socialite/callback/{provider}', 'SocialRegistrationController@registerWithProvider');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

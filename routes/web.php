<?php

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

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/','HouseController@index');

Route::get('/contact','HouseController@contact');

//Route::get('/about','HouseController@about');
Route::view('/about','about.index');

Route::post('/message','HouseController@store');

Route::get('/test','HouseController@test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/payment','HouseController@payment')->name('payment');
Route::get('/payment/success','HouseController@success');
Route::get('/cart','HouseController@cart');

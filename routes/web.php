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

//Route::get('/', function () {    return view('welcome');});


Route::get('/', 'HomeController@index')->name('home');

Route::get('/my-cup-cakes', 'HomeController@user_cup_cakes')->name('my_cup_cakes');
Route::post('/claim-cup-cake', 'HomeController@claim_cup_cake')->name('claim_url');
Route::get('/home', 'HomeController@index');


Auth::routes();



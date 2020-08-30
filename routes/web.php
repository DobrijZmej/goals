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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('goals', 'GoalController');
Route::get('goals/{goal}/destroy', 'GoalController@destroy')->name('goals.destroy.link')->middleware('auth');
Route::resource('moves', 'MovesController');
Route::get('moves/{goal}/destroy', 'MovesController@destroy')->name('moves.destroy.link')->middleware('auth');
/*
Route::get('goals', 'GoalController@index')->name('goals');
Route::get('goals/create', 'GoalController@create')->name('goals.create')->middleware('auth');
Route::post('goals/store', 'GoalController@store')->name('goals.store')->middleware('auth');
Route::post('goals/destroy', 'GoalController@store')->name('goals.store')->middleware('auth');
*/

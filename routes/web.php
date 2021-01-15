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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'karyawan'], function () {
    Route::get('/', 'KaryawanController@index');
    Route::get('/add', 'KaryawanController@create');
    Route::post('/add', 'KaryawanController@store');
    Route::group(['prefix' => '{karyawan_id}'], function () {
        Route::get('/', 'KaryawanController@show');
        Route::get('/edit', 'KaryawanController@edit');
        Route::put('/edit', 'KaryawanController@update');
        Route::delete('/', 'KaryawanController@destroy');
    });
});

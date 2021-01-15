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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'karyawan'], function () {
    Route::get('/', 'API\KaryawanController@index');
    Route::post('/', 'API\KaryawanController@store');
    Route::group(['prefix' => '{karyawan_id}'], function () {
        Route::get('/', 'API\KaryawanController@show');
        Route::put('/', 'API\KaryawanController@update');
        Route::delete('/', 'API\KaryawanController@destroy');
    });
});

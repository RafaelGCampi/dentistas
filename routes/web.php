<?php

use Illuminate\Support\Facades\Redirect;
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
    return Redirect('/dentistas');
});

Route::prefix('/dentistas')->name('dentistas.')->group(function () {
    Route::get('/', 'DentistasController@index')->name('index');
    Route::post('/store', 'DentistasController@store');
    Route::get('/list', 'DentistasController@list');
    Route::delete('/delete/{dentistas}', 'DentistasController@destroy');
    Route::get('/edit/{dentistas}', 'DentistasController@edit');
    Route::get('/form', 'DentistasController@show');
    Route::post('/search', 'DentistasController@search');
});

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

Route::get('/', 'indexController@index');

Route::get('/Population', 'PopulationController@index');
Route::get('/Wage', 'WageController@index');
Route::get('/Tax', 'TaxController@index');
Route::get('/Land', 'LandController@index');
Route::get('/Estate', 'EstateController@index');
Route::get('/Municipality', 'MunicipalityController@index');

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/nomina', 'ImpuestoNominaController@index')->name('nomina');
Route::get('/nomina_declaracion', 'ImpuestoNominaController@declaracion')->name('nomina_declaracion');
Route::get('/nomina_edoscta', 'ImpuestoNominaController@estados')->name('nomina_edoscta');
Route::post('/xmlsat', 'ImpuestoNominaController@xmlsat')->name('xmlsat');;


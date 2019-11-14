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
Route::get('/perfil', 'HomeController@perfil')->name('perfil');
Route::get('/notificaciones', 'HomeController@notificaciones')->name('notificaciones');

Route::post('/getSubactividades', 'HomeController@getSubactividades')->name('getSubactividades');
Route::post('/savePerfil', 'HomeController@savePerfil')->name('savePerfil');
Route::post('/pdf_download', 'HomeController@pdfDownload')->name('pdfDownload');

Route::get('/nomina', 'ImpuestoNominaController@index')->name('nomina');
Route::get('/nomina_registro', 'ImpuestoNominaController@registro')->name('nomina_registro');
Route::get('/nomina_declaracion', 'ImpuestoNominaController@declaracion')->name('nomina_declaracion');
Route::get('/nomina_edoscta', 'ImpuestoNominaController@estados')->name('nomina_edoscta');
Route::post('/xmlsat', 'ImpuestoNominaController@xmlsat')->name('xmlsat');

Route::get('/getpdf', function(){
    return Storage::download("notificacion/perfil/SOSS821123JK1.pdf");
});	


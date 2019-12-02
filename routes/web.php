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

Route::get('/panel', 'PanelController@index')->name('panel');

Route::get('/users', 'UserController@users')->name('users');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/perfil', 'HomeController@perfil')->name('perfil');
Route::get('/notificaciones', 'HomeController@notificaciones')->name('notificaciones');

Route::post('/getSubactividades', 'HomeController@getSubactividades')->name('getSubactividades');
Route::post('/getActividades', 'HomeController@getActividades')->name('getActividades');
Route::post('/getCodigos', 'HomeController@getCodigos')->name('getCodigos');
Route::post('/savePerfil', 'HomeController@savePerfil')->name('savePerfil');

Route::get('/perfilDownload/{rfc}', 'HomeController@perfilDownload')->name('perfilDownload');
Route::get('/constanciaDownload/{rfc}', 'HomeController@constanciaDownload')->name('constanciaDownload');
Route::get('/comprobanteDownload/{rfc}', 'HomeController@comprobanteDownload')->name('comprobanteDownload');
Route::get('/getpdf/{file}', 'HomeController@getpdf')->name('getpdf');


Route::get('/nomina', 'ImpuestoNominaController@index')->name('nomina');
Route::get('/nomina_registro', 'ImpuestoNominaController@registro')->name('nomina_registro');
Route::get('/nomina_declaracion', 'ImpuestoNominaController@declaracion')->name('nomina_declaracion');
Route::get('/nomina_edoscta', 'ImpuestoNominaController@estados')->name('nomina_edoscta');
Route::post('/xmlsat', 'ImpuestoNominaController@xmlsat')->name('xmlsat');
Route::post('/saveRegistro', 'ImpuestoNominaController@saveRegistro')->name('saveRegistro');


Route::get('/hospedaje', 'ImpuestoHospedajeController@index')->name('hospedaje');
Route::get('/hospedaje_registro', 'ImpuestoHospedajeController@registro')->name('hospedaje_registro');
Route::get('/hospedaje_declaracion', 'ImpuestoHospedajeController@declaracion')->name('hospedaje_declaracion');
Route::get('/hospedaje_edoscta', 'ImpuestoHospedajeController@estados')->name('hospedaje_edoscta');

Route::get('/opinionDownload', function(){
	return Storage::download("notificacion/perfil/reporteOpinion32DContribuyente.pdf");
})->name('opinionDownload');



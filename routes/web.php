<?php


use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Session;

//Rutas generales
Route::get('/index', function () { return view('seccion_principal'); });
Route::post('/login' , 'LoginController@is_user');
Route::get('/acerca_de',function(){return view('seccion_acerca_de');});
Route::get('/logout','LogoutController@logout');
Route::get('/contactar',function(){return view('seccion_contactar');});

//Rutas de analiticas de faunas
Route::get('/analiticas_faunas', 'AnaliticaFaunasController@index');
Route::get('/analiticas_faunas/new',function(){return view('catalogo.analiticas_faunas.new_analitica');});
Route::post('/analiticas_faunas/new', 'AnaliticaFaunasController@create');
Route::post('/analiticas_faunas/delete','AnaliticaFaunasController@delete');
Route::get('/analiticas_faunas/{id}','AnaliticaFaunasController@get_analitica');
Route::post('/analiticas_faunas/update','AnaliticaFaunasController@update');



Route::get('/uds_estratigraficas','UdsEstratigraficasController@index');
Route::get('/uds_estratigraficas/new',function(){return view('catalogo.uds_estratigraficas.new_uds_estratigrafica');});
Route::post('/uds_estratigraficas/new','UdsEstratigraficasController@create');
Route::get('/uds_estratigraficas/{id}','UdsEstratigraficasController@get_ud_estratigrafica');



Route::get('/articulos',function(){return view('catalogo.bibliografia.seccion_articulos');});

Route::get('/objetos', function (){return view ('catalogo.objetos.seccion_objetos');});

Route::get('/cataloguePic','CatalogoController@retrievePic');
Route::get('/pruebas',function(){

    return Session::get('logged');
return view('pruebas');

});



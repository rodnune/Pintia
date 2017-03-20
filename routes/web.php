<?php


use Illuminate\Support\Facades\Route;

//Rutas generales
Route::get('/index', function () { return view('seccion_principal'); });
Route::post('/login' , 'LoginController@is_user');
Route::get('/acerca_de',function(){return view('seccion_acerca_de');});
Route::get('/logout','LogoutController@logout');
Route::get('/contactar',function(){return view('seccion_contactar');});

//Rutas de analiticas de faunas
Route::get('/analiticas_faunas', 'AnaliticaFaunasController@index');
Route::get('/analiticas_faunas/new',function(){return view('catalogo.analiticas_faunas.new_analitica');});
Route::post('/analiticas_faunas/new','AnaliticaFaunasController@create');
Route::post('/analiticas_faunas/delete','AnaliticaFaunasController@delete');
Route::get('/analiticas_faunas/{id}','AnaliticaFaunasController@get_analitica');
Route::post('/analiticas_faunas/update','AnaliticaFaunasController@update');


Route::get('/articulos',function(){return view('catalogo.bibliografia.seccion_articulos');});

Route::get('/objetos', function (){return view ('catalogo.objetos.seccion_objetos');});

Route::get('/cataloguePic','CatalogoController@retrievePic');
Route::get('/pruebas',function(){

return view('pruebas');

});



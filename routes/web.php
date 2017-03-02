<?php


use Illuminate\Support\Facades\Route;
use App\Models\AnaliticaFauna;

Route::get('/index', function () { return view('seccion_principal'); });
Route::post('/login' , 'LoginController@is_user');
Route::get('/acerca_de',function(){return view('seccion_acerca_de');});
Route::get('/index/analiticas_faunas', 'AnaliticaFaunasController@index');
Route::get('index/analiticas_faunas/new',function(){return view('catalogo.analiticas_faunas.new_analitica');});
Route::post('/index/analiticas_faunas/new','AnaliticaFaunasController@create');
Route::post('/analitica_fauna', 'AnaliticaFaunasController@single');
Route::get('/index/logout','LogoutController@logout');
Route::get('/index/objetos', function (){return view ('catalogo.objetos.seccion_objetos');});
Route::get('/pruebas',function(){


});



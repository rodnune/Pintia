<?php


use Illuminate\Support\Facades\Route;

Route::get('/index', function () { return view('seccion_principal'); });
Route::post('/login' , 'LoginController@is_user');
Route::get('/acerca_de',function(){return view('seccion_acerca_de');});
Route::get('/analiticas_faunas', 'AnaliticaFaunasController@index');
Route::get('/analiticas_faunas/new',function(){return view('catalogo.analiticas_faunas.new_analitica');});
Route::post('/analiticas_faunas/new','AnaliticaFaunasController@create');
Route::post('/analitica_fauna', 'AnaliticaFaunasController@single');
Route::get('/articulos',function(){return view('catalogo.bibliografia.seccion_articulos');});
Route::get('/logout','LogoutController@logout');
Route::get('/objetos', function (){return view ('catalogo.objetos.seccion_objetos');});
Route::get('/contactar',function(){return view('seccion_contactar');});
Route::get('/cataloguePic','CatalogoController@retrievePic');
Route::get('/pruebas',function(){

    $file = File::get('images/logo-bg.png');


    return response($file, 200)->header('Content-Type', 'image/png');

});



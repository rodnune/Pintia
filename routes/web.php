<?php


use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
Route::get('/ud_estratigrafica/{id}','UdsEstratigraficasController@get_update_ud_estratigrafica');
Route::post('/ud_estratigrafica/update','UdsEstratigraficasController@update');

//componentes geologicos de una UE
Route::get('/ud_estratigrafica_cgeologicos/{id}','CGeologicosController@indexUE');
Route::post('/ud_estratigrafica_cgeologicos/asociar','CGeologicosController@asociarUE');
Route::post('/ud_estratigrafica_cgeologicos/delete','CGeologicosController@eliminarAsociacionUE');

//componentes organicos de una UE
Route::get('/ud_estratigrafica_corganicos/{id}','COrganicosController@indexUE');
Route::post('/ud_estratigrafica_corganicos/asociar','COrganicosController@asociarUE');
Route::post('/ud_estratigrafica_corganicos/delete','COrganicosController@eliminarAsociacionUE');

//componentes artificiales de una UE
Route::get('/ud_estratigrafica_cartificiales/{id}','CArtificialesController@indexUE');
Route::post('/ud_estratigrafica_cartificiales/asociar','CArtificialesController@asociarUE');
Route::post('/ud_estratigrafica_cartificiales/delete','CArtificialesController@eliminarAsociacionUE');

//superficies de una UE
Route::get('/ud_estratigrafica_superficies/{id}','SuperficiesController@indexUE');
Route::post('/ud_estratigrafica_superficies/asociar','SuperficiesController@asociarUE');
Route::post('/ud_estratigrafica_superficies/delete','SuperficiesController@eliminarAsociacionUE');

//artefactos de una UE
Route::get('/ud_estratigrafica_artefactos/{id}','ArtefactosController@indexUE');
Route::post('/ud_estratigrafica_artefactos/asociar','ArtefactosController@asociarUE');
Route::post('/ud_estratigrafica_artefactos/delete','ArtefactosController@eliminarAsociacionUE');

//dietas de fauna de una UE

Route::get('/ud_estratigrafica_dietas/{id}','AnaliticaFaunasController@indexUE');
Route::post('/ud_estratigrafica_dietas/asociar','AnaliticaFaunasController@asociarUE');
Route::post('/ud_estratigrafica_dietas/delete','AnaliticaFaunasController@eliminarAsociacionUE');

//relaciones estratigraficas de una UE
Route::get('/ud_estratigrafica_relaciones/{id}','RelacionesEstratigraficasController@indexUE');
Route::post('/ud_estratigrafica_relaciones/asociar','RelacionesEstratigraficasController@asociarUE');
Route::post('/ud_estratigrafica_relaciones/delete','RelacionesEstratigraficasController@eliminarAsociacionUE');

//matrices de Harris de una UE
Route::get('/ud_estratigrafica_matrixharris/{id}','MatrixHarrisController@indexUE');
Route::post('/ud_estratigrafica_matrixharris/asociar','MatrixHarrisController@asociarMatrixHarris');
Route::post('/ud_estratigrafica_matrixharris/delete','MatrixHarrisController@eliminarMatrixHarris');

//muestras de una UE
Route::get('/ud_estratigrafica_muestras/{id}','MuestrasController@indexUE');
Route::post('/ud_estratigrafica_muestras/asociar','MuestrasController@asociarUE');
Route::post('/ud_estratigrafica_muestras/delete','MuestrasController@eliminarAsociacionUE');

//localizacion de una ue
Route::get('/ud_estratigrafica_localizacion/{id}','LocalizacionController@indexUE');
Route::post('/ud_estratigrafica_localizacion/asociar','LocalizacionController@asociarUE');
Route::post('/ud_estratigrafica_localizacion/delete','MuestrasController@eliminarAsociacionUE');

//relaciones estratigraficas

Route::get('/relaciones_estratigraficas','RelacionesEstratigraficasController@index');
Route::post('/relaciones_estratigraficas/delete','RelacionesEstratigraficasController@delete');

//matrices de Harris

Route::get('/matrices_harris','MatrixHarrisController@index');
Route::post('/matrices_harris/delete','MatrixHarrisController@delete');
Route::get('/matriz_harris', 'MatrixHarrisController@get');
Route::post('matriz_harris','MatrixHarrisController@update');

Route::get('/articulos',function(){return view('catalogo.bibliografia.seccion_articulos');});

Route::get('/objetos', function (){return view ('catalogo.objetos.seccion_objetos');});

Route::get('/cataloguePic','CatalogoController@retrievePic');
Route::get('/pruebas',function(){

    //return Session::get('logged');
    //mapa
return view('pruebas');

});



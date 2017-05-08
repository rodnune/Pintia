<?php


use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\UnidadEstratigrafica;

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


//bibliografia artículos
Route::get('/articulos','ArticulosController@index');
Route::get('/articulo/{id}','ArticulosController@get_articulo');
Route::get('/articulo_new',function(){return view('catalogo.bibliografia.articulos.layout_new_articulo');});
Route::post('/articulo_new','ArticulosController@create');
Route::get('/editar_articulo','ArticulosController@get_form_update');
Route::post('/editar_articulo','ArticulosController@update');
Route::post('delete_articulo','ArticulosController@delete');

Route::get('/articulo/{id}/palabras_clave','PalabrasClaveController@indexArticulo');
Route::post('/articulo_palabras_clave/delete','PalabrasClaveController@eliminarAsociacionArticulo');
Route::post('/articulo_palabras_clave/add','PalabrasClaveController@asociarArticulo');

Route::get('/articulo/{id}/autores','AutoresController@indexArticulo');
Route::post('/articulo_autores/delete','AutoresController@eliminarAsociacionArticulo');
Route::post('/articulo_autores/add','AutoresController@asociarArticulo');



//bibliografia autores

Route::get('/autores','AutoresController@index');
Route::get('/autor_new',function(){return view('catalogo.bibliografia.autores.layout_new_autor');});
Route::post('/autor_new','AutoresController@create');
Route::post('/autor_delete','AutoresController@delete');
Route::get('/editar_autor','AutoresController@get_form_update');
Route::post('/editar_autor','AutoresController@update');
Route::get('/autor/{id}', 'AutoresController@get_autor');

//muestras

Route::get('/muestras','MuestrasController@index');
Route::get('/new_muestra',function(){return view('catalogo.muestras.layout_new_muestra');});
Route::post('/new_muestra','MuestrasController@create');
Route::post('/delete_muestra','MuestrasController@delete');
Route::get('/muestra/{id}','MuestrasController@get');
Route::post('/update_muestra','MuestrasController@update');
Route::post('/muestra_delete_tipo','MuestrasController@eliminarAsociacion');
Route::post('/muestra_add_tipo','MuestrasController@addAsociacion');

//inhumaciones
Route::get('/inhumaciones','InhumacionesController@index');
Route::get('/new_inhumacion','InhumacionesController@form_create');
Route::post('/new_inhumacion','InhumacionesController@create');
Route::get('/inhumacion/{id}','InhumacionesController@get');
Route::get('/search_inhumaciones','InhumacionesController@search');
Route::post('/delete_inhumacion','InhumacionesController@delete');
Route::get('/edit_inhumacion','InhumacionesController@form_update');
Route::post('/edit_inhumacion','InhumacionesController@update');


//cremaciones
Route::get('/cremaciones','CremacionesController@index');
Route::get('/new_cremacion','CremacionesController@form_create');
Route::post('/new_cremacion','CremacionesController@create');
Route::get('/cremacion/{id}','CremacionesController@get');
Route::delete('/delete_cremacion','CremacionesController@delete');
Route::get('/edit_cremacion','CremacionesController@form_update');
Route::post('/edit_cremacion','CremacionesController@update');
Route::get('/search_cremaciones','CremacionesController@search');


//tumbas
Route::get('/tumbas','TumbasController@index');
Route::get('/new_tumba','TumbasController@form_create');
Route::post('/new_tumba','TumbasController@create');
Route::get('/edit_tumba','TumbasController@form_update');
Route::post('/edit_tumba','TumbasController@update');
Route::get('/tumba/{id}','TumbasController@get');
Route::get('/tumba_tipos/{id}','TumbasController@index_tipos');
Route::post('/tumba_tipos/asociar','TumbasController@asociar_tipo_tumba');
Route::post('/tumba_tipos/delete','TumbasController@eliminar_asoc_tipo_tumba');

Route::get('/objetos', function (){return view ('catalogo.objetos.seccion_objetos');});

//otros
Route::get('/cataloguePic','CatalogoController@retrievePic');
Route::get('/pruebas',function(){

    $ud =  \App\Models\Inhumacion::all()->last()->IdEnterramiento;
    return $ud;

return view('pruebas');

});



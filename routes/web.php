<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CheckIfExperto;

//Rutas generales
Route::get('/', function () { return view('seccion_principal'); });
Route::post('/index' , 'LoginController@is_user');
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

//UE

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
Route::get('/search_tumba','TumbasController@search');

//tipos de tumbas de una tumba
Route::get('/tumba_tipos/{id}','TumbasController@index_tipos');
Route::post('/tumba_tipos/asociar','TumbasController@asociar_tipo_tumba');
Route::post('/tumba_tipos/delete','TumbasController@eliminar_asoc_tipo_tumba');

//cremaciones de una tumba
Route::get('/tumba_cremaciones/{id}','TumbasController@cremaciones_tumba');
Route::post('/tumba_cremaciones/asociar','TumbasController@asociar_cremacion');
Route::post('/tumba_cremaciones/delete','TumbasController@eliminar_asoc_cremacion');

//inhumaciones de una tumba
Route::get('/tumba_inhumaciones/{id}','TumbasController@inhumaciones_tumba');
Route::post('/tumba_inhumaciones/asociar','TumbasController@asociar_inhumacion');
Route::post('/tumba_inhumaciones/delete','TumbasController@eliminar_asoc_inhumacion');

//localizacion tumba
Route::get('/tumba_localizacion/{id}','TumbasController@localizacion_tumba');
Route::post('/tumba_localizacion/asociar','TumbasController@asociar_localizacion');
Route::delete('/tumba_localizacion/delete','TumbasController@eliminar_asoc_localizacion');

//UE tumba
Route::get('/tumba_ue/{id}','TumbasController@ue_tumba');
Route::post('/tumba_ue/asociar','TumbasController@asociar_ue');
Route::delete('/tumba_ue/delete','TumbasController@eliminar_asoc_ue');


//Ofrendas tumba

Route::get('/tumba_ofrendas/{id}','TumbasController@ofrendas_tumba');
Route::post('/tumba_ofrendas/asociar','TumbasController@asociar_ofrenda');
Route::delete('/tumba_ofrendas/delete','TumbasController@eliminar_asoc_ofrenda');


//Multimedia

Route::get('/multimedias', 'MultimediaController@index');
Route::get('/new_multimedia','MultimediaController@form_create');
Route::post('/new_multimedia','MultimediaController@create');
Route::get('/archivo/{id}','MultimediaController@getArchivo');
Route::get('/edit_multimedia/{id}','MultimediaController@form_update');
Route::post('/edit_multimedia','MultimediaController@update');
Route::get('/delete_multimedia/{id}','MultimediaController@delete');

//Analisis metalografico
Route::get('/analisis_objeto/{id}','AnalisisMetalController@nuevo');
Route::post('/new_analisis','AnalisisMetalController@nuevo_analisis');
Route::get('/gestion_analisis/{id}','AnalisisMetalController@gestionar');
Route::get('/analisis_metalograficos','AnalisisMetalController@index');
Route::get('/analisis_metalografico/{id}','AnalisisMetalController@get');
Route::post('/update_analisis','AnalisisMetalController@update');
Route::delete('/delete_analisis','AnalisisMetalController@delete');


//Objetos

Route::get('/objetos','ObjetosController@index');
Route::get('/new_objeto',function(){return view('catalogo.objetos.layout_new_objeto');});
Route::post('/new_objeto','ObjetosController@create');
Route::get('/objeto/{id}','ObjetosController@get_objeto');
Route::get('/objeto_datos_generales/{id}','ObjetosController@get_datos');
Route::post('/objeto_update','ObjetosController@update_general_data');

//Partes Objeto
Route::get('/objeto_clasificacion_partes/{id}','ObjetosController@get_clasificacion_partes');
Route::post('/add_parte_objeto','PartesObjetoController@addParte');
Route::get('/parte_objeto/{id}','PartesObjetoController@get_parte');
Route::post('/gestionar_parte_objeto','PartesObjetoController@update');
Route::delete('/delete_parte_objeto','PartesObjetoController@delete');

//MaterialesObjeto

Route::get('/materiales_objeto/{id}','ObjetosController@get_materiales_objeto');
Route::post('/gestionar_material_parte','PartesObjetoController@gestion_materiales_parte');
Route::get('/material_parte_objeto/{id}/{ref}','ObjetosController@get_material_objeto');

//Medidas Parte Objeto

Route::get('/medidas_parte_objeto/{id}','PartesObjetoController@get_medidas_parte_objeto');
Route::get('/medidas_parte_objeto/{ref}/{id}','PartesObjetoController@get_medida_parte_objeto');
Route::post('/gestion_medida_parte','PartesObjetoController@gestionar_medidas_parte');

//Localizacion Objeto
Route::get('/localizacion_objeto/{id}','ObjetosController@get_localizacion');
Route::post('/asignar_localizacion_objeto','ObjetosController@asignar_localizacion');


//Articulos objeto
Route::get('/articulos_objeto/{id}','ObjetosController@get_articulos');
Route::post('/gestion_articulos_objeto','ObjetosController@gestion_articulos_objeto');




//GESTION LISTAS

Route::get('/gestion_keywords','PalabrasClaveController@get');
Route::post('/gestion_keywords','PalabrasClaveController@gestionar');
Route::get('/gestion_materia_prima','MateriaPrimaController@get');
Route::post('/gestion_materia_prima','MateriaPrimaController@gestionar');
Route::get('/gestion_tipos_tumba','TiposTumbaController@get');
Route::post('/gestion_tipos_tumba','TiposTumbaController@gestionar');
Route::get('/gestion_tipos_muestra','MuestrasController@get_tipos');
Route::post('/gestion_tipos_muestra','MuestrasController@gestionar');
Route::get('/gestion_artificiales','CArtificialesController@get');
Route::post('/gestion_artificiales','CArtificialesController@gestionar');
Route::get('/gestion_geologicos','CGeologicosController@get');
Route::post('/gestion_geologicos','CGeologicosController@gestionar');
Route::get('/gestion_organicos','COrganicosController@get');
Route::post('/gestion_organicos','COrganicosController@gestionar');
Route::get('/gestion_artefactos','ArtefactosController@get');
Route::post('/gestion_artefactos','ArtefactosController@gestionar');
Route::get('/gestion_superficies','SuperficiesController@get');
Route::post('/gestion_superficies','SuperficiesController@gestionar');


//GESTION MEDIDAS Y CATEGORIAS

Route::get('/gestion_medidas','MedidasCategoriaController@get_medidas');
Route::post('/gestion_medidas','MedidasCategoriaController@gestionar_medida');
Route::get('/medida/{id}','MedidasCategoriaController@get_medida');

Route::get('/gestion_categorias','MedidasCategoriaController@get_categorias');
Route::post('/gestion_categorias','MedidasCategoriaController@gestionar_categoria');
Route::get('/categoria/{id}','MedidasCategoriaController@get_categoria');
Route::post('/gestionar_medida_categoria','MedidasCategoriaController@gestionar_medida_categoria');

Route::post('/gestion_subcategorias','MedidasSubcategoriaController@gestionar_subcategoria');
Route::get('/subcategoria/{id}','MedidasSubcategoriaController@get_subcategoria');
Route::post('/gestion_medida_subcategoria','MedidasSubcategoriaController@gestionar_medida');

//otras rutas

Route::get('/subcategorias/{id}','MedidasCategoriaController@get_subcategorias');



//GESTION GEOGRAFIA
Route::group(['middleware' => ['experto']], function () {
    Route::get('/gestion_lugares','LugaresController@get_lugares');
    Route::get('/lugar/{id}','LugaresController@get');
    Route::post('/gestion_lugares','LugaresController@gestion_lugares');
    Route::get('/gestion_localizaciones','LocalizacionController@get_localizaciones');
    Route::get('/localizaciones/{id}','LocalizacionController@localizaciones_lugar');
    Route::get('/localizacion_nueva','LocalizacionController@form_create');
    Route::post('/localizacion_nueva','LocalizacionController@create');
    Route::get('/localizacion/{id}','LocalizacionController@get');
    Route::post('/gestion_localizacion','LocalizacionController@gestionar');
});


//GESTION REGISTROS

Route::get('/registros','RegistrosController@index');




//GESTION USUARIOS

Route::get('/usuarios','UsuariosController@index');
Route::get('/usuario/{id}','UsuariosController@get_usuario');
Route::get('/new_usuario','UsuariosController@form_create');
Route::post('/new_usuario','UsuariosController@create');
Route::get('/delete_usuario/{id}','UsuariosController@delete_usuario');


Route::get('/search_usuarios','UsuariosController@search');
Route::post('/update_usuario','UsuariosController@update');
Route::delete('/delete_usuario','UsuariosController@delete');



//Mensajes

Route::get('/mensajes','MensajesController@index');
Route::post('/enviar_mensaje','MensajesController@enviar_mensaje');
Route::get('/privados','MensajesController@privados');
Route::get('/expertos','MensajesController@expertos')->middleware(CheckIfExperto::class);
Route::get('/generales','MensajesController@generales');
Route::get('/noveles','MensajesController@noveles');
Route::get('/search_mensajes','MensajesController@search');
Route::post('/delete_mensaje','MensajesController@delete');


//Perfil

Route::get('/perfil','UsuariosController@profile');
Route::post('/delete_perfil','UsuariosController@delete_profile');



//otros
Route::get('/cataloguePic','CatalogoController@retrievePic');
Route::get('/pruebas',function(){





return view('pruebas');

});



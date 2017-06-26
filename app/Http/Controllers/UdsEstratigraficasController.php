<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 20/03/2017
 * Time: 13:27
 */

namespace app\Http\Controllers;


use App\Models\UnidadEstratigrafica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UdsEstratigraficasController extends \App\Http\Controllers\Controller
{
            public function index(){
                $uds_estratigraficas = UnidadEstratigrafica::all();

                $geologicos = DB::table('componentesgeologicos')->orderBy('denominacion')->get();
                $artificiales = DB::table('componentesartificiales')->orderBy('denominacion')->get();
                $organicos = DB::table('componentesorganicos')->orderBy('denominacion')->get();

                return view('catalogo.uds_estratigraficas.layout_uds_estratigraficas',['uds_estratigraficas' => $uds_estratigraficas,
                'geologicos' => $geologicos,'organicos' => $organicos,'artificiales' => $artificiales]);
            }

            public function create(Request $request){
                $new_ud_estratigrafica = new UnidadEstratigrafica();
                $id = $request ->input('id_ue');

                $validator = Validator::make($request->all(), [


                    'id_ue' => 'required|min:0|unique:unidadestratigrafica,UE',
                ]);

                if ($validator->fails()) {
                    return redirect('/new_ud_estratigrafica')
                        ->withErrors($validator);
                }

                $new_ud_estratigrafica->UE = $id;

                $new_ud_estratigrafica->save();

                return redirect('/uds_estratigraficas')->with('success','Unidad estratigrafica con id: '.$id.' creada correctamente');
            }

            public function get_ud_estratigrafica($id){
                $ud_estratigrafica = UnidadEstratigrafica::find($id);

               $componentes_organicos =   $ud_estratigrafica->componentesOrganicosAsociados();
               $componentes_geologicos = $ud_estratigrafica->componentesGeologicosAsociados();
               $componentes_artificiales = $ud_estratigrafica->componentesArtificialesAsociados();
               $analiticas = $ud_estratigrafica->analiticasAsociadasUE();
               $superficies = $ud_estratigrafica->superficiesAsociadas();
               $artefactos = $ud_estratigrafica->artefactosAsociados();

                $localizacion = $ud_estratigrafica->localizacion();


                $relaciones = $ud_estratigrafica->relacionesEstratigraficas();
                $matrix_harris = $ud_estratigrafica->matrixHarris();




                return view('catalogo.uds_estratigraficas.layout_unidad',['ud_estratigrafica' => $ud_estratigrafica,
                    'componentes_organicos' => $componentes_organicos,'componentes_geologicos' => $componentes_geologicos,
                    'componentes_artificiales' => $componentes_artificiales,'analiticas' => $analiticas,
                    'superficies' => $superficies,'artefactos' => $artefactos,'localizacion' => $localizacion,
                    'relaciones' => $relaciones, 'matrix_harris' => $matrix_harris

                    ]);
            }

            public function get_update_ud_estratigrafica($id){
               $ud_estratigrafica = UnidadEstratigrafica::find($id);

                $pendientes = $ud_estratigrafica->camposPendientes()->keyBy('NombreCampo')->all();
                $pendientes = collect($pendientes);

                return view('catalogo.uds_estratigraficas.layout_form_update',
                    ['ud_estratigrafica' => $ud_estratigrafica,'pendientes' => $pendientes]);
            }

            public function update(Request $request){

                $id = $request ->input('id');

                $validator = Validator::make($request->all(), [


                    'id'                        => 'required|exists:unidadestratigrafica,ue',
                    'descripcion'               => 'string',
                    'interpretacion'            => 'string',
                    'observaciones'             => 'string',
                    'unidad'                    => 'in:Natural,Zoologica,Antropica,Indeterminado',
                    'tipo_unidad'               => 'in:Estrato,Superficie',
                    'estratoc1'                 => 'in:Compacta,Suelta',
                    'estratoc2'                 => 'in:Homogenea,Heterogenea',
                    'excavada'                  => 'in:No excavada,Parcialmente,Totalmente',
                    'alzada'                    => 'in:Alzada unica,Varias alzadas',
                    'fiabilidad'                => 'in:Completa,Problematica',



                ]);

                if ($validator->fails()) {
                    return redirect('/ud_estratigrafica/'.$id.'/datos_generales')
                        ->withErrors($validator);
                }
                $ud_estratigrafica = UnidadEstratigrafica::find($id);

                        $new_descripcion = $request ->input('descripcion');
                        $new_observaciones = $request ->input('observaciones');
                        $new_interpretacion = $request ->input('interpretacion');
                        $new_estrato_color = $request -> input('ecolor');
                        $new_tecnica = $request -> input('tecnica');
                        $new_unidad_accion = $request -> input('unidad_accion');
                        $new_tipo_unidad = $request -> input('tipo_unidad');
                        $new_estrato_constitucion1 = $request -> input('estratoc1');
                        $new_estrato_constitucion2 = $request -> input('estratoc2');
                        $new_excavada = $request -> input('excavada');
                        $new_alzada = $request -> input('alzada');
                        $new_fiabilidad = $request -> input('fiabilidad');

                        $ud_estratigrafica->EstratoColor = $new_estrato_color;
                        $ud_estratigrafica->TecnicaExcavacion = $new_tecnica;
                        $ud_estratigrafica->UnidadAccion = $new_unidad_accion;
                        $ud_estratigrafica->TipoUnidad = $new_tipo_unidad;
                        $ud_estratigrafica->EstratoConstitucion1 = $new_estrato_constitucion1;
                        $ud_estratigrafica->EstratoConstitucion2 = $new_estrato_constitucion2;
                        $ud_estratigrafica->Excavada = $new_excavada;
                        $ud_estratigrafica->Alzada = $new_alzada;
                        $ud_estratigrafica->EstratigrafiaFiabilidad = $new_fiabilidad;
                        $ud_estratigrafica->Interpretacion = $new_interpretacion;
                        $ud_estratigrafica->EstratigrafiaObservaciones = $new_observaciones;
                        $ud_estratigrafica->Descripcion = $new_descripcion;


                $ud_estratigrafica->save();


                return redirect('/ud_estratigrafica/'.$id.'/datos_generales')
                    ->with('success','Unidad estratigrafica con: '.$id.' modificada correctamente');


            }


            public function get_pendientes($id){
                    $ud_estratigrafica = UnidadEstratigrafica::find($id);

                    $pendientes = $ud_estratigrafica->camposPendientes();
                    $completados = $ud_estratigrafica->camposCompletados();


                    return view('catalogo.uds_estratigraficas.layout_pendientes',
                        ['ud_estratigrafica' => $ud_estratigrafica,'pendientes' => $pendientes,'completados' => $completados]);


            }

            public function marcar_pendiente(Request $request){
                $id = $request->input('id');
                $campo = $request->input('campo');

                $validator = Validator::make($request->all(), [
                    'id'           => 'required|exists:unidadestratigrafica,ue',
                    'campo' => 'required|exists:camposue,idcampo',
                ]);

                if ($validator->fails()) {
                    return redirect('/ud_estratigrafica/'.$id.'/pendientes')->withErrors($validator);
                }

                DB::table('pendienteue')
                    ->insert(['ue' => $id,'idcampo' => $campo]);

                return redirect('/ud_estratigrafica/'.$id.'/pendientes')->with('success','Campo añadido a pendientes');

            }

            public function marcar_completado(Request $request){

                $id = $request->input('id');
                $campo = $request->input('hecho');

                $validator = Validator::make($request->all(), [
                    'id'           => 'required|exists:unidadestratigrafica,ue',
                    'hecho'        => 'required|exists:camposue,idcampo',
                ]);

                if ($validator->fails()) {
                    return redirect('/ud_estratigrafica/'.$id.'/pendientes')->withErrors($validator);
                }


                DB::table('pendienteue')
                    ->where('ue','=',$id)
                    ->where('idcampo','=',$campo)
                    ->delete();

                return redirect('/ud_estratigrafica/'.$id.'/pendientes')->with('success','Campo añadido a completados');
            }



}
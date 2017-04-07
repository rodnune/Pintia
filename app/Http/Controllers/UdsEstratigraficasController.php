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

                return view('catalogo.uds_estratigraficas.layout_uds_estratigraficas',['uds_estratigraficas' => $uds_estratigraficas]);
            }

            public function create(Request $request){
                $new_ud_estratigrafica = new UnidadEstratigrafica();
                $id = $request ->input('id_ue');

                $validator = Validator::make($request->all(), [



                    'id_ue' => 'required|min:0|unique:unidadestratigrafica,UE',
                ]);

                if ($validator->fails()) {
                    return redirect('/uds_estratigraficas/new')
                        ->withErrors($validator);
                }

                $new_ud_estratigrafica->UE = $id;

                $new_ud_estratigrafica->save();

                return redirect('/uds_estratigraficas');
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
                    'superficies' => $superficies,'artefactos' => $artefactos,'localizacion' => $localizacion[0],
                    'relaciones' => $relaciones, 'matrix_harris' => $matrix_harris

                    ]);
            }

            public function get_update_ud_estratigrafica($id){
               $ud_estratigrafica = UnidadEstratigrafica::find($id);
                return view('catalogo.uds_estratigraficas.layout_form_update',['ud_estratigrafica' => $ud_estratigrafica]);
            }

            public function update(Request $request){
                $id = $request ->input('id');
                $ud_estratigrafica = UnidadEstratigrafica::find($id);
                /*
               * Si no se introduce nada, en los campos de texto
               * se dejan los antiguos valores
               */
                        $new_descripcion = $request ->input('descripcion');

                        if($new_descripcion != ""){

                            $ud_estratigrafica->Descripcion = $new_descripcion;
                        }

                        $new_observaciones = $request ->input('observaciones');

                        if($new_observaciones !=  ""){
                            $ud_estratigrafica->EstratigrafiaObservaciones = $new_observaciones;
                        }

                $new_interpretacion = $request ->input('interpretacion');

                if($new_interpretacion !=  ""){
                    $ud_estratigrafica->Interpretacion = $new_interpretacion;
                }

                $new_estrato_color = $request -> input('ecolor');
                $new_tecnica = $request -> input('tecnica');

                /*
                 * Validacion de Enums
                 */
                $validator = Validator::make($request->all(), [



                    'unidad'      => 'in:Natural,Zoologica,Antropica,Indeterminado',
                    'tipo_unidad' => 'in:Estrato,Superficie',
                    'estratoc1'   => 'in:Compacta,Suelta',
                    'estratoc2'   => 'in:Homogenea,Heterogenea',
                    'excavada'    => 'in:No excavada,Parcialmente,Totalmente',
                    'alzada'      => 'in:Alzada unica,Varias alzadas',
                    'fiabilidad'  => 'in:Completa,Problematica',



                ]);

                if ($validator->fails()) {
                    return redirect('/ud_estratigrafica/'.$id)
                        ->withErrors($validator);
                }



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



                $ud_estratigrafica->save();


                return redirect('/uds_estratigraficas/'.$id);


            }



}
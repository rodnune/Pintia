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



                    'id_ue' => 'required||min:0|unique:unidadestratigrafica,UE',
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
                return view('catalogo.uds_estratigraficas.layout_unidad',['id' => $id]);
            }



}
<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 30/03/2017
 * Time: 23:53
 */

namespace app\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class MedidasCategoriaController extends \App\Http\Controllers\Controller
{

    public function get(){

        $medidas = DB::table('medidas')->orderBy('siglasmedida')->get();

        return view('gestion.medidas_categoria.layout_medidas',['medidas' => $medidas]);
    }


    public function gestionar_medida(Request $request)
    {


        if ($request->submit == 'Agregar') {
            $siglas = $request->input('new_siglas');
            $denominacion = $request->input('new_denominacion');
            $uds = $request->input('new_unidades');

            $validator = Validator::make($request->all(), [
                'new_siglas' => 'required|string|unique:medidas,siglasmedida',
                'new_denominacion' => 'required|string',
                'new_unidades' => 'required|string'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_medidas')->withErrors($validator);
            }

            DB::table('medidas')->insert(['siglasmedida' => $siglas, 'denominacion' => $denominacion,
                'unidades' => $uds]);

            return redirect('/gestion_medidas');
        }
    }

                public function get_medida($id){
                        
                  $medida =  DB::table('medidas')->where('siglasmedida','=',$id)->get();

                  return $medida;

        }





}
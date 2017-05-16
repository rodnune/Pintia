<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 05/04/2017
 * Time: 11:59
 */

namespace app\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class TiposTumbaController extends \App\Http\Controllers\Controller
{

    public function get(){

        $tipos_tumba =  DB::table('tipostumbas')->orderBy('denominacion')->get();


        return view('gestion.layout_tipos_tumbas',['tipos' => $tipos_tumba ]);

    }

    public function gestionar(Request $request){

        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:tipostumbas,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_tipos_tumba')->withErrors($validator);
            }
            DB::table('tipostumbas')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_tipos_tumba');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:tipostumbas,idtipotumba',
                'reemplazar' => 'required|unique:tipostumbas,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_tipos_tumba')->withErrors($validator);
            }

            DB::table('tipostumbas')
                ->where('idtipotumba','=',$keyword)
                ->update(['denominacion' => $keyword_update]);


            return redirect('/gestion_tipos_tumba');
        }


        if($request->submit == 'Borrar'){
            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:tipostumbas,idtipotumba',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_tipos_tumba')->withErrors($validator);
            }

            DB::table('tipostumbas')
                ->where('idtipotumba','=',$keyword)
                ->delete();


            return redirect('/gestion_tipos_tumba');
        }
    }
}
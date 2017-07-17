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

class MateriaPrimaController extends \App\Http\Controllers\Controller
{

public function get(){

   $materias =  DB::table('materiaprima')->orderBy('denominacion')->get();


   return view('gestion.listas.layout_materia_prima',['materias' => $materias ]);

}

    public function gestionar(Request $request){

        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:materiaprima,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_materia_prima')->withErrors($validator);
            }
            DB::table('materiaprima')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_materia_prima')->with('success','Materia prima: '.$keyword.' creada correctamente');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:materiaprima,idmat',
                'reemplazar' => 'required|unique:materiaprima,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_materia_prima')->withErrors($validator);
            }

            $materia_prima =   DB::table('materiaprima')
                ->where('idmat','=',$keyword)->first();

            DB::table('materiaprima')
                ->where('idmat','=',$keyword)
                ->update(['denominacion' => $keyword_update]);



            return redirect('/gestion_materia_prima')
                ->with('success','Materia prima: '.$materia_prima->Denominacion.' actualizada correctamente');
        }


        if($request->submit == 'Borrar'){
            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:materiaprima,idmat',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_materia_prima')->withErrors($validator);
            }

            $materia_prima =   DB::table('materiaprima')
                ->where('idmat','=',$keyword)->first();


            DB::table('materiaprima')
                ->where('idmat','=',$keyword)
                ->delete();


            return redirect('/gestion_materia_prima')
                ->with('success','Materia prima: '.$materia_prima->Denominacion.' borrada correctamente');
        }





    }





}
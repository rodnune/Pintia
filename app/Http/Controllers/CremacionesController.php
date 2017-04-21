<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 20/04/2017
 * Time: 21:24
 */

namespace app\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Config;

class CremacionesController extends \App\Http\Controllers\Controller
{

    public function index(){

        $cremaciones = DB::table('cremacion')->get(['IdCremacion','UE','CodigoPropio'
            ,'Observaciones']);


        return view('catalogo.cremaciones.layout_cremaciones',['cremaciones' => $cremaciones]);
    }

    public function form_create(){
        $ud_estratigraficas =  DB::table('unidadestratigrafica')->get(['UE']);

        return view('catalogo.cremaciones.layout_new_cremacion',['ud_estratigraficas' => $ud_estratigraficas]);
    }


    public function create(Request $request){

                $ue                 = $request -> input('ue');
                $codigo             = $request -> input('codigo');
                $presentacion       = $request -> input('presentacion');
                $peso               = $request -> input('peso');
                $sexo               = $request -> input('sexo');
                $edad               = $request -> input('edad');
                $calidad_combustion = $request -> input('calidad');
                $analisis           = $request -> input('analisis');
                $descripcion        = $request -> input('descripcion');
                $observaciones      = $request -> input('observaciones');


        $validator = Validator::make($request->all(), [
            'ue' => 'required|numeric',
            'codigo' => 'required|alpha_num',
            'presentacion' => 'string',
            'peso' => 'numeric|min:0',
            'sexo' => 'in:' . implode(',', Config::get('enums.sexo')),
            'edad' => 'string',
            'calidad' => 'string',
            'analisis' => 'integer',
            'descripcion' => 'string',
            'observaciones' => 'string'


        ]);

        if ($validator->fails()) {
            return redirect('/new_cremacion')
                ->withErrors($validator);
        }



        DB::table('cremacion')->insert(['UE' => $ue,'CodigoPropio' => $codigo , 'Presentacion' => $presentacion,
        'Peso' => $peso, 'Descripcion' => $descripcion, 'Sexo' => $sexo , 'Edad' => $edad,
        'CalidadCombustion' => $calidad_combustion , 'AnalisisPosdeposicional' => $analisis,
        'Observaciones' => $observaciones]);



        return redirect('/cremaciones');

    }


    public function get($id){
           $inhumacion =    DB::table('cremacion')->where('IdCremacion','=',$id)->get();

           return $inhumacion;

    }

}
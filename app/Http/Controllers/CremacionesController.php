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
use App\Models\Cremacion;
use Validator;
use Config;

class CremacionesController extends \App\Http\Controllers\Controller
{

    public function index(){

        $ud_estratigraficas =  DB::table('unidadestratigrafica')->get(['UE']);
        $cremaciones = DB::table('cremacion')->get(['IdCremacion','UE','CodigoPropio'
            ,'Observaciones','Sexo']);

        $tumbas = DB::table('tumba')->get(['IdTumba']);


        return view('catalogo.cremaciones.layout_cremaciones',['cremaciones' => $cremaciones,'ud_estratigraficas' => $ud_estratigraficas
            ,'tumbas' => $tumbas]);
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
            'ue' => 'required|numeric|exists:unidadestratigrafica,ue',
            'codigo' => 'required|alpha_num|unique:cremacion,CodigoPropio',
            'presentacion' => 'string',
            'peso' => 'required|numeric|min:0',
            'sexo' => 'in:' . implode(',', Config::get('enums.sexo')),
            'edad' => 'string',
            'calidad' => 'string',
            'analisis' => 'required|integer',
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



        return redirect('/cremaciones')->with('success','Cremacion creada con exito');

    }


    public function get($id){
           $cremacion =    DB::table('cremacion')->where('IdCremacion','=',$id)->get()->first();


           return view('catalogo.cremaciones.layout_cremacion',['cremacion' => $cremacion ]);

    }


    public function delete(Request $request){
                $id = $request->input('id');

        DB::table('cremacion')->where('IdCremacion', '=', $id)->delete();


        return redirect('/cremaciones');

    }

    public function form_update(Request $request){

        $id = $request->input('id');

        $ud_estratigraficas =  DB::table('unidadestratigrafica')->get(['UE']);
        $cremacion =    Cremacion::find($id);


        return view('catalogo.cremaciones.layout_update',['ud_estratigraficas' => $ud_estratigraficas
            , 'cremacion' => $cremacion]);
    }


    public function update(Request $request){
        $id                 = $request ->input('id');
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
            'codigo' => 'required|alpha_num|unique:cremacion,codigopropio,'.$codigo.',CodigoPropio',
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
            return CremacionesController::form_update($request)->withErrors($validator);
        }


        DB::table('cremacion')
            ->where('IdCremacion', $id)
            ->update(['UE' => $ue, 'CodigoPropio' => $codigo, 'Presentacion' => $presentacion
                , 'Peso' => $peso, 'Descripcion' => $descripcion, 'Sexo' => $sexo,
                'Edad' => $edad, 'CalidadCombustion' => $calidad_combustion, 'AnalisisPosdeposicional' => $analisis,
                'Observaciones' => $observaciones ]);

        return redirect('/cremacion/'.$id);

    }


    public function search(Request $request,Cremacion $cremacion){

        $cremaciones =  $cremacion->newQuery();

        $datos = collect();

        if($request->has('filtro_ue')){
            $cremaciones->where('UE', $request->input('filtro_ue'));

            $datos->put('UE',$request->input('filtro_ue'));
        }


        if($request->has('filtro_sexo')){
            $cremaciones->where('Sexo', $request->input('filtro_sexo'));

            $datos->put('sexo',$request->input('filtro_sexo'));
        }

        if($request->has('filtro_tumba')) {
            $cremaciones->whereIn('idcremacion', function ($q) {
                $q->select('cremacionestumba.idcremacion')->from('cremacionestumba')
                    ->where('cremacionestumba.idtumba', '=', $_REQUEST['filtro_tumba']);

            });

            $datos->put('tumba',$request->input('filtro_tumba'));
        }

        $cremaciones = $cremaciones->get();


        return CremacionesController::index()->with(['cremaciones' => $cremaciones,'datos' => $datos]);

    }



}
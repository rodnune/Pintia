<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 14/04/2017
 * Time: 1:14
 */

namespace app\Http\Controllers;

use App\Models\UnidadEstratigrafica;
use App\Models\Inhumacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Config;
use Illuminate\Support\Facades\DB;



class InhumacionesController extends \App\Http\Controllers\Controller
{

    public function index(){



        $inhumaciones = DB::table('inhumacion')->get(['IdEnterramiento','UECadaver'
            ,'UERelleno','UEFosa','UEEstructura','Descripcion']);

        $ud_estratigraficas = UnidadEstratigrafica::all();

        $tumbas = DB::table('tumba')->get(['IdTumba']);

        return view('catalogo.inhumaciones.layout_inhumaciones',['inhumaciones' => $inhumaciones,
            'ud_estratigraficas' => $ud_estratigraficas,'tumbas' => $tumbas ]);
    }

    public function search(Request $request,Inhumacion $inhumacion){

              $inhumaciones =  $inhumacion->newQuery();
              $datos_consulta = collect();

        if($request->has('filtro_cadaver')){
           $inhumaciones->where('UECadaver', $request->input('filtro_cadaver'));

           $datos_consulta->put('UECadaver',$request->input('filtro_cadaver'));
        }

        if($request->has('filtro_fosa')){
          $inhumaciones->where('UEFosa', $request->input('filtro_fosa'));

            $datos_consulta->put('UEFosa',$request->input('filtro_fosa'));
        }

        if($request->has('filtro_estructura')){
            $inhumaciones->where('UEEstructura', $request->input('filtro_estructura'));

            $datos_consulta->put('UEEstructura',$request->input('filtro_estructura'));
        }

        if($request->has('filtro_relleno')){
            $inhumaciones->where('UERelleno', $request->input('filtro_relleno'));


            $datos_consulta->put('UERelleno',$request->input('filtro_relleno'));

        }

        if($request->has('filtro_tumba')){

            $inhumaciones->whereIn('identerramiento', function ($q) {
                $q->select('inhumacionestumba.identerramiento')->from('inhumacionestumba')
                    ->where('inhumacionestumba.idtumba', '=', $_REQUEST['filtro_tumba']);



        });

           $datos_consulta->put('Tumba',$request->input('filtro_tumba'));
        }

        $inhumaciones = $inhumaciones->get();



        return InhumacionesController::index()->with(['datos' => $datos_consulta,'inhumaciones' => $inhumaciones]);
    }


        public function create(Request $request)
        {
            $ue_cadaver = $request->input('ue_cadaver');
            $ue_fosa = $request->input('ue_fosa');
            $ue_estructura = $request->input('ue_estructura');
            $ue_relleno = $request->input('ue_relleno');
            $fecha = $request->input('fecha');
            $orientacion = $request->input('orientacion');
            $edad = $request->input('edad');
            $adscripcion = $request->input('adscripcion');
            $tiene_ajuar = $request->input('tiene_ajuar');
            $ajuar = $request->input('ajuar');
            $conservacion = $request->input('conservacion');
            $conexion = $request->input('conexion');
            $posicion = $request->input('posicion');
            $actitud = $request->input('actitud');
            $sexo = $request->input('sexo');
            $medidas = $request->input('medidas');
            $descripcion = $request->input('descripcion');
            $observaciones = $request->input('observaciones');

            $validator = Validator::make($request->all(), [
                'ue_cadaver' => 'numeric',
                'ue_fosa' => 'numeric',
                'ue_estructura' => 'numeric',
                'ue_relleno' => 'numeric',
                'actual' => 'required|date',
                'fecha' => 'required|date|before_or_equal:actual',
                'orientacion' => 'string',
                'edad' => 'string',
                'adscripcion' => 'string',
                'tiene_ajuar' => 'required|in:Si,No',
                'ajuar' => 'required_if:tiene_ajuar,Si|string',
                'conservacion' => 'in:Completa,Parcial',
                'conexion' => 'in:Articulado,Desarticulado',
                'posicion' => 'in:' . implode(',', Config::get('enums.inhumacion_posicion')),
                'actitud' => 'in:' . implode(',', Config::get('enums.inhumacion_actitud')),
                'sexo' => 'in:' . implode(',', Config::get('enums.sexo')),
                'medidas' => 'string',
                'descripcion' => 'required|string',
                'observaciones' => 'string'


            ]);

            if ($validator->fails()) {
                return redirect('/new_inhumacion')
                    ->withErrors($validator);
            }

            DB::table('inhumacion')->insert(['UECadaver' => $ue_cadaver, 'Fecha' => $fecha, 'UEFosa' => $ue_fosa
                , 'UEEstructura' => $ue_estructura, 'UERelleno' => $ue_relleno, 'TieneAjuar' => $tiene_ajuar,
                'Orientacion' => $orientacion, 'Conservacion' => $conservacion, 'ConexAnatomica' => $conexion,
                'Posicion' => $posicion, 'Actitud' => $actitud, 'MedidasEsqueleto' => $medidas,
                'Sexo' => $sexo, 'Edad' => $edad, 'Descripcion' => $descripcion, 'Ajuar' => $ajuar,
                'AdscricionCulturalCronologia' => $adscripcion, 'Observaciones' => $observaciones]);

            if ((Session::get('admin_level') == 1) || (Session::get('admin_level') == 2)) {

                $id_enterramiento = Inhumacion::all()->last()->IdEnterramiento;
                DB::table('registro')
                    ->insert(['user_id' => Session::get('user_id'), 'Fecha' => $fecha,
                        'IdEnterramiento' => $id_enterramiento, 'admin_level' => Session::get('admin_level')]);


            }
            return redirect('/inhumaciones')->with('success','Inhumacion creada correctamente');
        }

    public function delete(Request $request){
                $id = $request->input('id');


        DB::table('inhumacion')->where('IdEnterramiento', '=', $id)->delete();

        DB::table('inhumacionestumba')->where('IdEnterramiento', '=', $id)->delete();

        return redirect('/inhumaciones')->with('success','Inhumacion borrada correctamente');

    }

    public function get($id){
            $inhumacion = Inhumacion::find($id);

            return view('catalogo.inhumaciones.layout_inhumacion',['inhumacion' => $inhumacion]);


    }


    public function form_create(){
        $ud_estratigraficas =  UnidadEstratigrafica::all();

        return view('catalogo.inhumaciones.layout_new_inhumacion',['ud_estratigraficas' => $ud_estratigraficas]);
    }

    public function form_update(Request $request){

                $id = $request->input('id');

        $inhumacion = Inhumacion::find($id);
        $ud_estratigraficas = DB::table('unidadestratigrafica')->get(['UE']);


        return view('catalogo.inhumaciones.layout_update',['ud_estratigraficas' => $ud_estratigraficas
            ,'inhumacion' => $inhumacion]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $ue_cadaver = $request->input('ue_cadaver');
        $ue_fosa = $request->input('ue_fosa');
        $ue_estructura = $request->input('ue_estructura');
        $ue_relleno = $request->input('ue_relleno');
        $fecha = $request->input('fecha');
        $orientacion = $request->input('orientacion');
        $edad = $request->input('edad');
        $adscripcion = $request->input('adscripcion');
        $tiene_ajuar = $request->input('tiene_ajuar');
        $ajuar = $request->input('ajuar');
        $conservacion = $request->input('conservacion');
        $conexion = $request->input('conexion');
        $posicion = $request->input('posicion');
        $actitud = $request->input('actitud');
        $sexo = $request->input('sexo');
        $medidas = $request->input('medidas');
        $descripcion = $request->input('descripcion');
        $observaciones = $request->input('observaciones');


        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'ue_cadaver' => 'numeric',
            'ue_fosa' => 'numeric',
            'ue_estructura' => 'numeric',
            'ue_relleno' => 'numeric',
            'actual' => 'required|date',
            'fecha' => 'date|before_or_equal:actual',
            'orientacion' => 'string',
            'edad' => 'string',
            'adscripcion' => 'string',
            'tiene_ajuar' => 'required|in:Si,No',
            'ajuar' => 'required_if:tiene_ajuar,si|string',
            'conservacion' => 'in:Completa,Parcial',
            'conexion' => 'in:Articulado,Desarticulado',
            'posicion' => 'in:' . implode(',', Config::get('enums.inhumacion_posicion')),
            'actitud' => 'in:' . implode(',', Config::get('enums.inhumacion_actitud')),
            'sexo' => 'in:' . implode(',', Config::get('enums.sexo')),
            'medidas' => 'string',
            'descripcion' => 'required|string',
            'observaciones' => 'string'


        ]);

        if ($validator->fails()) {

           return InhumacionesController::form_update($request)->withErrors($validator);

        }


        DB::table('inhumacion')
            ->where('IdEnterramiento', $id)
            ->update(['UECadaver' => $ue_cadaver, 'Fecha' => $fecha, 'UEFosa' => $ue_fosa
                , 'UEEstructura' => $ue_estructura, 'UERelleno' => $ue_relleno, 'TieneAjuar' => $tiene_ajuar,
                'Orientacion' => $orientacion, 'Conservacion' => $conservacion, 'ConexAnatomica' => $conexion,
                'Posicion' => $posicion, 'Actitud' => $actitud, 'MedidasEsqueleto' => $medidas,
                'Sexo' => $sexo, 'Edad' => $edad, 'Descripcion' => $descripcion, 'Ajuar' => $ajuar,
                'AdscricionCulturalCronologia' => $adscripcion, 'Observaciones' => $observaciones]);



        return redirect('/inhumacion/'.$id)->with('success','Inhumacion modificada correctamente');
    }





}
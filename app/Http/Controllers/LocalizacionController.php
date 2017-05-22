<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 31/03/2017
 * Time: 10:54
 */

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;


class LocalizacionController extends \App\Http\Controllers\Controller
{
    public function indexUE($id){

        $localizaciones = DB::table('localizacion')->get();



        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $localizacion = $ud_estratigrafica->localizacion();


        return view('catalogo.uds_estratigraficas.layout_localizacion',['ud_estratigrafica' => $ud_estratigrafica, 'localizacion' => $localizacion[0], 'localizaciones' => $localizaciones]);


    }

    public function asociarUE(Request $request){
        $id_ue = $request->input('id');
        $localizacion = $request->input('localizacion');

        UnidadEstratigrafica::where('UE',$id_ue)->update(['IdLocalizacion' => $localizacion]);

        return redirect('/ud_estratigrafica_localizacion/'.$id_ue);
    }


    public function get_localizaciones(){

         $lugares = DB::table('lugar')->orderBy('municipio')->get();

         $localizaciones = DB::table('localizacion')
             ->orderBy('siglazona')
             ->get();



        return view('gestion.geografia.layout_localizaciones',['lugares' => $lugares , 'localizaciones' => $localizaciones]);

    }


    public function  localizaciones_lugar($id){



            $localizaciones =	DB::table('localizacion')
                ->where('siglazona','=',$id)
                ->orderBy('sectortrama')
                ->orderBy('sectorsubtrama')
                ->get();

        return $localizaciones;


    }


    public function form_create(){

        $lugares = DB::table('lugar')->orderBy('siglazona')->get();

        return view('gestion.geografia.layout_new_localizacion',['lugares' => $lugares]);
    }

    public function create(Request $request){


        $lugar = $request->input('siglazona');
        $sector_trama    = $request->input('trama');
        $sector_subtrama = $request->input('subtrama');
        $notas = $request->input('notas');


        $validator = Validator::make($request->all(), [

            'siglazona' => 'required|exists:lugar,SiglaZona',
            'trama'  => 'required|string',
            'subtrama' => 'required|string'

        ]);



        if ($validator->fails()) {

            return redirect('/localizacion_nueva')->withErrors($validator);
        }



        DB::table('localizacion')->insert(['siglazona' => $lugar, 'sectortrama' => $sector_trama,
            'sectorsubtrama' => $sector_subtrama,'notas' => $notas]);


        return redirect('/gestion_localizaciones');


    }


    public function get($id){

      $localizacion =  DB::table('localizacion')->where('idlocalizacion','=',$id)->first();

        return $localizacion->SiglaZona;

    }




}
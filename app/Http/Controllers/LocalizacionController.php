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
use Lang;
use URL;


class LocalizacionController extends \App\Http\Controllers\Controller
{
    public function indexUE($id){




        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $localizacion = $ud_estratigrafica->localizacion();

        $localizaciones = $ud_estratigrafica->localizacionesNoAsociadas();

        $pendientes = $ud_estratigrafica->camposPendientes()->keyBy('NombreCampo')->only(['Localizacion'])->all();
        $pendiente = collect($pendientes);
        $nota = $ud_estratigrafica->notaSeccion('Localizacion');




        return view('catalogo.uds_estratigraficas.layout_localizacion',['ud_estratigrafica' => $ud_estratigrafica,
            'localizacion' => $localizacion, 'localizaciones' => $localizaciones,'pendiente' => $pendiente,'nota' => $nota]);


    }

    public function asociarUE(Request $request){
        $id_ue = $request->input('id');
        $localizacion = $request->input('localizacion');


        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',
            'localizacion' => 'required|exists:localizacion,idlocalizacion'

        ]);

        if ($validator->fails()) {

            return redirect(URL::previous())->withErrors($validator);
        }


        UnidadEstratigrafica::where('UE',$id_ue)->update(['IdLocalizacion' => $localizacion]);

        return redirect('/ud_estratigrafica/'.$id_ue.'/localizacion')->with('success','Localizacion actualizada con exito');
    }

    public function eliminar_asoc_ue(Request $request){
        $id = $request->input('id');

        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',

        ]);

        if ($validator->fails()) {

            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('unidadestratigrafica')->where('ue','=',$id)
            ->update(['idlocalizacion' => NULL]);

        return redirect('/ud_estratigrafica/'.$id.'/localizacion')->with('success',Lang::get('messages.asociacion_eliminada'));


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



        $lugares = DB::table('lugar')->orderBy('siglazona')->get();

        return view('gestion.geografia.layout_localizacion',['lugares' => $lugares
            ,'localizacion' => $localizacion]);

    }


    public function gestionar(Request $request){

        $idlocal = $request->input('id');
        $lugar = $request->input('siglazona');
        $sector_trama    = $request->input('trama');
        $sector_subtrama = $request->input('subtrama');
        $notas = $request->input('notas');

        if($request->submit == 'Modificar'){



            $validator = Validator::make($request->all(), [
                'id'        => 'required|idlocalizacion',
                'siglazona' => 'required|exists:lugar,SiglaZona',
                'trama'  => 'required|string',
                'subtrama' => 'required|string'

            ]);

            if ($validator->fails()) {

                return redirect(URL::previous())->withErrors($validator);
            }



            DB::table('localizacion')->where('idlocalizacion','=',$idlocal)->update(['siglazona' => $lugar, 'sectortrama' => $sector_trama,
                'sectorsubtrama' => $sector_subtrama,'notas' => $notas]);


            return redirect('/localizacion/' . $idlocal);

        }

        if($request->submit == 'Borrar'){

            $validator = Validator::make($request->all(), [
                'id'        => 'required|exists:localizacion,idlocalizacion',

            ]);

            if ($validator->fails()) {

                return redirect(URL::previous())->withErrors($validator);
            }



            DB::table('localizacion')->where('idlocalizacion','=',$idlocal)->delete();


            return redirect('/gestion_localizaciones');
        }





    }




}
<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 04/05/2017
 * Time: 17:37
 */

namespace app\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Config;
use App\Models\Tumba;
use Illuminate\Support\Facades\Session;


class TumbasController extends \App\Http\Controllers\Controller
{

    public function index(){



       $campanyas =  DB::table('tumba')->select('anyocampanya')->distinct()->orderBy('anyocampanya')->get();

        $tipos = DB::table('tipostumbas')->orderBy('denominacion')->get();

        $localizaciones = DB::table('localizacion')->get(['IdLocalizacion','SectorTrama','SectorSubtrama']);


       $tumbas =  DB::table('tumba')->orderBy('IdTumba')->get();

        return view('catalogo.tumbas.layout_tumbas',['tumbas' => $tumbas,
            'campanyas' => $campanyas, 'tipos' => $tipos,'localizaciones' => $localizaciones]);
    }


    public function create(Request $request){

        $id = $request ->input('id_tumba');

        $validator = Validator::make($request->all(), [

            'id_tumba' => 'required|unique:tumba,IdTumba',
        ]);



        if ($validator->fails()) {
            return redirect('/new_tumba')
                ->withErrors($validator);
        }

        DB::table('tumba')->insert(['idtumba' => $id,'user_id' => Session::get('user_id') ]);

//REGISTRAR ENTRADA por Arqueólogo Novel Y Experto
        if ((Session::get('admin_level') == 1) || (Session::get('admin_level') == 2)) {

                $fecha = Carbon::now()->toDateString();
            DB::table('registro')
                ->insert(['user_id' => Session::get('user_id'), 'Fecha' => $fecha,
                    'IdTumba' => $id, 'admin_level' => Session::get('admin_level')]);

        }




        return redirect('/tumbas')->with('success', 'Tumba creada con exito');
    }


    public function get_datos($id){


        $tumba = Tumba::find($id);

        $ud_estratigraficas = DB::table('unidadestratigrafica')->orderBy('ue')->get(['UE']);





        return view('catalogo.tumbas.layout_update',['tumba' => $tumba,'uds_estratigraficas' => $ud_estratigraficas]);
    }


    public function update(Request $request){
                $id           = $request ->input('id_tumba');
                $neonato      = $request->input('neonato');
                $anyo         = $request->input('anyo');
                $conservacion = $request->input('conservacion');
                $estructura   = $request->input('estructura');
                $composicion  = $request->input('composicion');
                $organizacion = $request->input('organizacion');
                $restos_humanos   = $request->input('restos');
                $ofrendas         = $request->input('ofrendas');
                $ue = $request->input('ue');


        $validator = Validator::make($request->all(), [
            'id_tumba' => 'required|exists:tumba,idtumba',
            'anyo' => 'numeric|min:1970|max:' . date("Y") ,
            'neonato' => 'in:' . implode(',', Config::get('enums.bool')),
            'conservacion' => 'string',
            'estructura' => 'string',
            'composicion' => 'string',
            'organizacion' => 'string',
            'restos' => 'string',
            'ofrendas' => 'string',
            'ue'    => 'nullable|exists:unidadestratigrafica,ue'


        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/datos_generales')->withErrors($validator);
        }
        if(!$request->has('ue')){

         $ue = NULL;
        }


        DB::table('tumba')->where('IdTumba','=',$id)->update(['NeonatoCasa' => $neonato,
            'AnyoCampanya' => $anyo,'Conservacion' => $conservacion,'Estructura' => $estructura,
        'Composicion' => $composicion,'OrganizacionYJerarquia' => $organizacion,'RestosHumanos' => $restos_humanos,
        'OfrendasAnimales' => $ofrendas,'UE' => $ue]);

        return redirect('/tumba/'.$id.'/datos_generales')->with('success','Datos modificados correctamente');





    }


    public function get($id){



        $tumba = Tumba::find($id);

        //Objetos asociados a la tumba

        $tipos_tumba  = $tumba->tiposTumbaAsociados();
        $cremaciones  = $tumba->cremacionesAsociadas();
        $inhumaciones = $tumba->inhumacionesAsociadas();
        $localizacion = $tumba->localizacion();
        $ofrendas     = $tumba->ofrendasAsociadas();
        $multimedias  = $tumba->multimediaAsociado();
        $objetos      = $tumba->objetosAsociados();







        return view('catalogo.tumbas.layout_tumba',['tumba' => $tumba,'tipos_tumba' => $tipos_tumba,
            'cremaciones' => $cremaciones,'inhumaciones' => $inhumaciones,'localizacion' => $localizacion,
        'ofrendas' => $ofrendas,'multimedias' => $multimedias,'objetos' => $objetos]);

    }


    public function search(Request $request,Tumba $tumba){

        $datos_consulta = collect();
        $tumbas =  $tumba->newQuery();

        if($request->has('anio')){
            $tumbas->where('AnyoCampanya', $request->input('anio'));

                $datos_consulta->put('anio',$request->input('anio'));
        }

        if($request->has('tipo_tumba')){

            /*
             * Necesitamos acceder globalmente a la peticion
             */

            $tumbas->whereIn('idtumba',function($q){
                $q->select('tumbaesdetipo.idtumba')->from('tumbaesdetipo')
                    ->where('tumbaesdetipo.idtipotumba','=',$_REQUEST['tipo_tumba']);

            });

            $tipo_tumba = DB::table('tipostumbas')->where('idtipotumba','=',$_REQUEST['tipo_tumba'])->get()->first();


            $datos_consulta->put('tipo',$tipo_tumba->Denominacion);
            }

        if($request->has('lugar')){
            $tumbas->where('localizacion', $request->input('lugar'));

            $lugar = DB::table('localizacion')->where('IdLocalizacion','=',$request->input('lugar'))->get()->first();

            $datos_consulta->put('sector_trama',$lugar->SectorTrama);
            $datos_consulta->put('sector_subtrama',$lugar->SectorSubtrama);



        }

        $tumbas = $tumbas->get();


        $campanyas =  DB::table('tumba')->select('anyocampanya')->distinct()->orderBy('anyocampanya')->get();

        $tipos = DB::table('tipostumbas')->orderBy('denominacion')->get();

        $localizaciones = DB::table('localizacion')->get(['IdLocalizacion','SectorTrama','SectorSubtrama']);

        return view('catalogo.tumbas.layout_tumbas',['tumbas' => $tumbas,
            'campanyas' => $campanyas, 'tipos' => $tipos,'localizaciones' => $localizaciones,'datos' => $datos_consulta]);



    }

    public function index_tipos($id){



        $tumba = Tumba::find($id);


        $asociadas = $tumba->tiposTumbaAsociados();


        $no_asociadas = $tumba->tiposTumbaSinAsociar();




        return view('catalogo.tumbas.layout_tipos_tumba',['tumba'=> $tumba ,'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);

    }



    public function asociar_tipo_tumba(Request $request){

            $id = $request->input('id');
            $tipo = $request->input('tipo');




        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:tumba,idtumba',
            'tipo' => 'required|exists:tipostumbas,idtipotumba',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/tipos')->withErrors($validator);
        }

        DB::table('tumbaesdetipo')->insert(['IdTumba' => $id,'IdTipoTumba'=> $tipo]);


        return redirect('/tumba/'.$id.'/tipos')->with('success','Tipo de tumba asociado correctamente');
    }

    public function eliminar_asoc_tipo_tumba(Request $request){


        $id = $request->input('id');
        $tipo = $request->input('tipo');




        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:tumba,idtumba',
            'tipo' => 'required|exists:tipostumbas,idtipotumba',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/tipos')->withErrors($validator);
        }


        DB::table('tumbaesdetipo')
            ->where('IdTumba','=',$id)
            ->where('IdTipoTumba','=',$tipo)
            ->delete();


        return redirect('/tumba/'.$id.'/tipos')->with('success','Asociacion eliminada correctamente');
    }

    public function cremaciones_tumba($id){


        $tumba = Tumba::find($id);


        $asociadas = $tumba->cremacionesAsociadas();
        $no_asociadas = $tumba->cremacionesSinAsociar();



        return view('catalogo.tumbas.layout_cremaciones_tumba',['tumba'=> $tumba ,'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);


    }

    public function asociar_cremacion(Request $request){

        $id = $request->input('id');
        $cremacion = $request->input('cremacion');




        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:tumba,idtumba',
            'cremacion' => 'required|exists:cremacion,idcremacion',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id .'/cremaciones')->withErrors($validator);
        }

        DB::table('cremacionestumba')->insert(['IdTumba' => $id,'IdCremacion'=> $cremacion]);

        return redirect('/tumba/'.$id .'/cremaciones')->with('success','Cremacion asociada correctamente');
    }

    public function eliminar_asoc_cremacion(Request $request){

        $id = $request->input('id');
        $cremacion = $request->input('cremacion');




        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:tumba,idtumba',
            'cremacion' => 'required|exists:cremacion,idcremacion',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id .'/cremaciones')->withErrors($validator);
        }


        DB::table('cremacionestumba')
            ->where('IdTumba','=',$id)
            ->where('IdCremacion','=',$cremacion)
            ->delete();




        return redirect('/tumba/'.$id .'/cremaciones')->with('success','Asociacion eliminada correctamente');
    }


    public function inhumaciones_tumba($id){


        $tumba = Tumba::find($id);


        $asociadas = $tumba->inhumacionesAsociadas();
        $no_asociadas = $tumba->inhumacionesSinAsociar();



        return view('catalogo.tumbas.layout_inhumaciones_tumba',['tumba'=> $tumba ,'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);


    }

    public function asociar_inhumacion(Request $request){

        $id = $request->input('id');
        $inhumacion = $request->input('inhumacion');




        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:tumba,idtumba',
            'inhumacion' => 'required|exists:inhumacion,identerramiento',
        ]);

        if ($validator->fails()) {

            return redirect('/tumba/'.$id.'/inhumaciones')->withErrors($validator);
        }

        DB::table('inhumacionestumba')->insert(['IdTumba' => $id,'IdEnterramiento'=> $inhumacion]);

        return redirect('/tumba/'.$id.'/inhumaciones')->with('success','Inhumacion asociada correctamente');
    }

    public function eliminar_asoc_inhumacion(Request $request){

        $id = $request->input('id');
        $inhumacion = $request->input('inhumacion');




        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:tumba,idtumba',
            'inhumacion' => 'required|exists:inhumacion,identerramiento',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/inhumaciones')->withErrors($validator);
        }

        DB::table('inhumacionestumba')
            ->where('IdTumba','=',$id)
            ->where('IdEnterramiento','=',$inhumacion)
            ->delete();

        return redirect('/tumba/'.$id.'/inhumaciones')->with('success','Asociacion eliminada correctamente');
    }

    public function localizacion_tumba($id){


        $tumba = Tumba::find($id);


        $localizacion = $tumba->localizacion();
        $no_asociadas = $tumba->localizacionesNoAsociadas();



        return view('catalogo.tumbas.layout_localizacion_tumba',['tumba'=> $tumba
            ,'localizacion' => $localizacion,'no_asociadas' => $no_asociadas]);
    }


    public function asociar_localizacion(Request $request){

        $id = $request->input('id');
        $localizacion = $request->input('localizacion');

        $validator = Validator::make($request->all(), [
            'id'           => 'required|exists:tumba,idtumba',
            'localizacion' => 'required|exists:localizacion,idlocalizacion',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/localizacion')->withErrors($validator);
        }



        DB::table('tumba')->where('IdTumba','=',$id)
            ->update(['Localizacion' => $localizacion]);

            return redirect('/tumba/'.$id.'/localizacion')->with('success','Localizacion de la tumba actualizada');

    }


    public function eliminar_asoc_localizacion(Request $request){

        $id = $request->input('id');


        DB::table('tumba')->where('IdTumba','=',$id)
            ->update(['Localizacion' => NULL]);

        return redirect('/tumba/'.$id.'/localizacion')->with('success','Localizacion eliminada de la tumba');

    }




    public function ofrendas_tumba($id){


        $tumba = Tumba::find($id);


        $asociadas = $tumba->ofrendasAsociadas();
        $no_asociadas = $tumba->ofrendasNoAsociadas();




        return view('catalogo.tumbas.layout_ofrendas_tumba',['tumba'=> $tumba ,'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);


    }


    public function asociar_ofrenda(Request $request){
        $id = $request->input('id');
        $ofrenda = $request->input('ofrenda');




        $validator = Validator::make($request->all(), [
            'id'           => 'required|exists:tumba,idtumba',
            'ofrenda' => 'required|exists:analiticafaunas,idanalitica',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/ofrendas')->withErrors($validator);
        }

        DB::table('ofrendasfauna')->insert(['IdTumba' => $id,'IdAnalitica'=> $ofrenda]);

        return redirect('/tumba/'.$id.'/ofrendas')->with('success','Ofrenda asociada correctamente');
    }

    public function eliminar_asoc_ofrenda(Request $request){
        $id = $request->input('id');
        $ofrenda = $request->input('ofrenda');




        $validator = Validator::make($request->all(), [
            'id'           => 'required|exists:tumba,idtumba',
            'ofrenda' => 'required|exists:analiticafaunas,idanalitica',
        ]);

        if ($validator->fails()) {

            return redirect('/tumba/'.$id.'/ofrendas')->withErrors($validator);
        }


        DB::table('ofrendasfauna')
            ->where('IdTumba','=',$id)
            ->where('IdAnalitica','=',$ofrenda)
            ->delete();




        return redirect('/tumba/'.$id.'/ofrendas')->with('success','Asociacion eliminada correctamente');
    }


    public function multimedias_tumba($id){

        $tumba = Tumba::find($id);
        $asociados = $tumba->multimediaAsociado();
        $no_asociados = $tumba->multimediaNoAsociado();



        return view('catalogo.tumbas.layout_multimedias',['tumba' => $tumba,'asociados' => $asociados,'no_asociados' => $no_asociados]);


    }

    public function asociar_multimedia(Request $request){

        $id = $request->input('id');
        $multimedia = $request->input('multimedia');
        $orden = $request->input('orden');


        $validator = Validator::make($request->all(), [
            'id'           => 'required|exists:tumba,idtumba',
            'multimedia' => 'required|exists:almacenmultimedia,idmutimedia',
            'orden'       => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/multimedias')->withErrors($validator);
        }

        DB::table('multimediatumba')->insert(['idTumba' => $id,'idmultimedia'=> $multimedia,'orden' => $orden]);

        return redirect('/tumba/'.$id.'/multimedias')->with('success','Multimedia asociado correctamente');
    }

    public function eliminar_asoc_multimedia(Request $request){

        $id = $request->input('id');
        $multimedia = $request->input('multimedia');


        $validator = Validator::make($request->all(), [
            'id'           => 'required|exists:tumba,idtumba',
            'multimedia' => 'required|exists:almacenmultimedia,idmutimedia',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba/'.$id.'/multimedias')->withErrors($validator);
        }

        DB::table('multimediatumba')
            ->where('idtumba','=',$id)
            ->where('idmultimedia','=',$multimedia)
            ->delete();

        return redirect('/tumba/'.$id.'/multimedias')->with('success','Asociacion eliminada correctamente');
    }

}
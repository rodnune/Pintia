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

       $tumbas =  DB::table('tumba')->orderBy('IdTumba')->get();

        return view('catalogo.tumbas.layout_tumbas',['tumbas' => $tumbas]);
    }

    public function form_create(){

            return view('catalogo.tumbas.layout_new_tumba');
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

        DB::table('tumba')->insert(['IdTumba' => $id]);

//REGISTRAR ENTRADA por Arqueólogo Novel Y Experto
        if ((Session::get('admin_level') == 1) || (Session::get('admin_level') == 2)) {

                $fecha = Carbon::now()->toDateString();
            DB::table('registro')
                ->insert(['user_id' => Session::get('user_id'), 'Fecha' => $fecha,
                    'IdTumba' => $id, 'admin_level' => Session::get('admin_level')]);


        }




        return redirect('/tumbas');
    }


    public function form_update(Request $request){

        $id = $request->input('id');


        $tumba = DB::table('tumba')->where('IdTumba','=',$id)->get();





        return view('catalogo.tumbas.layout_update',['tumba' => $tumba[0]]);
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


        $validator = Validator::make($request->all(), [

            'anyo' => 'numeric|min:1970|max:' . date("Y") ,
            'neonato' => 'in:' . implode(',', Config::get('enums.bool')),
            'conservacion' => 'string',
            'estructura' => 'string',
            'composicion' => 'string',
            'organizacion' => 'string',
            'restos' => 'string',
            'ofrendas' => 'string'


        ]);

        if ($validator->fails()) {
            return TumbasController::form_update($request)->withErrors($validator);
        }


        DB::table('tumba')->where('IdTumba','=',$id)->update(['NeonatoCasa' => $neonato,
            'AnyoCampanya' => $anyo,'Conservacion' => $conservacion,'Estructura' => $estructura,
        'Composicion' => $composicion,'OrganizacionYJerarquia' => $organizacion,'RestosHumanos' => $restos_humanos,
        'OfrendasAnimales' => $ofrendas]);

        return redirect('/tumba/'.$id);





    }


    public function get($id){

        $tumba = DB::table('tumba')->where('IdTumba','=',$id)->get();




        return view('catalogo.tumbas.layout_tumba',['tumba' => $tumba[0]]);

    }

    public function index_tipos($id){

        $tumba_sidebar = DB::table('tumba')->where('IdTumba','=',$id)->get();

        $tumba = Tumba::where('IdTumba','=',$id)->first();


        $asociadas = $tumba->tiposTumbaAsociados();
        $no_asociadas = $tumba->tiposTumbaSinAsociar();


        return view('catalogo.tumbas.layout_tipos_tumba',['tumba'=> $tumba_sidebar[0] ,'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);

    }



    public function asociar_tipo_tumba(Request $request){

            $id = $request->input('id');
            $tipo = $request->input('tipo');




        $validator = Validator::make($request->all(), [
            'tipo' => 'required|exists:tipostumbas,idtipotumba',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba_tipos/'.$id)->withErrors($validator);
        }

        DB::table('tumbaesdetipo')->insert(['IdTumba' => $id,'IdTipoTumba'=> $tipo]);


        return redirect('/tumba_tipos/'.$id);
    }

    public function eliminar_asoc_tipo_tumba(Request $request){


        $id = $request->input('id');
        $tipo = $request->input('tipo');




        $validator = Validator::make($request->all(), [
            'tipo' => 'required|exists:tipostumbas,idtipotumba',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba_tipos/'.$id)->withErrors($validator);
        }

        DB::table('tumbaesdetipo')
            ->where('IdTumba','=',$id)
            ->where('IdTipoTumba','=',$tipo)
            ->delete();


        return redirect('/tumba_tipos/'.$id);
    }

    public function cremaciones_tumba($id){

        $tumba_sidebar = DB::table('tumba')->where('IdTumba','=',$id)->get();

        $tumba = Tumba::where('IdTumba','=',$id)->first();


        $asociadas = $tumba->cremacionesAsociadas();
        $no_asociadas = $tumba->cremacionesSinAsociar();



        return view('catalogo.tumbas.layout_cremaciones_tumba',['tumba'=> $tumba_sidebar[0] ,'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);


    }

    public function asociar_cremacion(Request $request){

        $id = $request->input('id');
        $cremacion = $request->input('cremacion');




        $validator = Validator::make($request->all(), [
            'cremacion' => 'required|exists:cremacion,idcremacion',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba_cremaciones/'.$id)->withErrors($validator);
        }

        DB::table('cremacionestumba')->insert(['IdTumba' => $id,'IdCremacion'=> $cremacion]);

        return redirect('/tumba_cremaciones/'.$id);
    }

    public function eliminar_asoc_cremacion(Request $request){

        $id = $request->input('id');
        $cremacion = $request->input('cremacion');




        $validator = Validator::make($request->all(), [
            'cremacion' => 'required|exists:cremacion,idcremacion',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba_cremaciones/'.$id)->withErrors($validator);
        }


        DB::table('cremacionestumba')
            ->where('IdTumba','=',$id)
            ->where('IdCremacion','=',$cremacion)
            ->delete();




        return redirect('/tumba_cremaciones/'.$id);
    }


    public function inhumaciones_tumba($id){

        $tumba_sidebar = DB::table('tumba')->where('IdTumba','=',$id)->get();

        $tumba = Tumba::where('IdTumba','=',$id)->first();


        $asociadas = $tumba->inhumacionesAsociadas();
        $no_asociadas = $tumba->inhumacionesSinAsociar();



        return view('catalogo.tumbas.layout_inhumaciones_tumba',['tumba'=> $tumba_sidebar[0] ,'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);


    }

    public function asociar_inhumacion(Request $request){

        $id = $request->input('id');
        $inhumacion = $request->input('inhumacion');




        $validator = Validator::make($request->all(), [
            'inhumacion' => 'required|exists:inhumacion,identerramiento',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba_inhumaciones/'.$id)->withErrors($validator);
        }

        DB::table('inhumacionestumba')->insert(['IdTumba' => $id,'IdEnterramiento'=> $inhumacion]);

        return redirect('/tumba_inhumaciones/'.$id);
    }

    public function eliminar_asoc_inhumacion(Request $request){

        $id = $request->input('id');
        $inhumacion = $request->input('inhumacion');




        $validator = Validator::make($request->all(), [
            'inhumacion' => 'required|exists:inhumacion,identerramiento',
        ]);

        if ($validator->fails()) {
            return redirect('/tumba_inhumaciones/'.$id)->withErrors($validator);
        }

        DB::table('inhumacionestumba')
            ->where('IdTumba','=',$id)
            ->where('IdEnterramiento','=',$inhumacion)
            ->delete();

        return redirect('/tumba_inhumaciones/'.$id);
    }





}
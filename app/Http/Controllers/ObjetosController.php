<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 02/03/2017
 * Time: 11:24
 */

namespace app\Http\Controllers;

use App\Models\ParteObjeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;
use Config;
use Carbon\Carbon;
use App\Models\Objeto;

class ObjetosController extends \App\Http\Controllers\Controller
{

    public function index(){

        $subcategorias = DB::table('categoria')->join('subcategoria', 'subcategoria.idcat', '=', 'categoria.idcat')
            ->select('categoria.denominacion as denominacioncat','subcategoria.denominacion as denominacionsubcat' ,'categoria.idcat','subcategoria.idsubcat')
            ->get();

        $grouped = $subcategorias->groupBy('idcat');

        $categorias = $grouped->toArray();

        $materiales = DB::table('materiaprima')->orderBy('denominacion')->get();

        $localizaciones = DB::table('localizacion')->get();



        if(Session::get('admin_level') > 0 )
        {
            $objetos = DB::table('fichaobjeto')->orderBy('ref')->get();
        }else{
            $objetos = DB::table('fichaobjeto')->where('visiblecatalogo','=','Si')->orderBy('ref')->get();
        }

        return view('catalogo.objetos.layout_objetos',['categorias' => $categorias,
            'materiales' => $materiales, 'localizaciones' => $localizaciones,'objetos' => $objetos]);

    }


    public function create(Request $request)
    {

        $referencia = $request->input('referencia');

        $validator = Validator::make($request->all(), [
            'referencia' => 'required|integer|min:0|unique:fichaobjeto,ref',
        ]);

        if ($validator->fails()) {
            return redirect('/new_objeto')->withErrors($validator);
        }

        DB::table('fichaobjeto')->insert(['ref' => $referencia, 'user_id' => Session::get('user_id')]);


        if ((Session::get('admin_level') > 0)) {
            //REGISTRAR ENTRADA


            $fecha = Carbon::now()->toDateString();

            DB::table('registro')->insert(['user_id' => Session::get('user_id') , 'fecha' => $fecha
                , 'ref' => $referencia , 'admin_level' => Session::get('admin_level')]);





        }

        return redirect('/objetos')->with('success', 'Objeto creado con exito');
    }


    public function get_objeto($id){

       $objeto = DB::table('fichaobjeto')->where('ref','=',$id)->get()->first();



        return view('catalogo.objetos.layout_objeto',['objeto' => $objeto]);
    }


    public function get_datos($id){

        $objeto = DB::table('fichaobjeto')->where('ref','=',$id)->get()->first();

        $ues = DB::table('unidadestratigrafica')->orderBy('ue')->get();
        $tumbas = DB::table('tumba')->orderBy('idtumba')->get();



        return view('catalogo.objetos.layout_datos_gen',['objeto' => $objeto,'uds_estratigraficas' => $ues,'tumbas' => $tumbas]);


    }

    public function get_clasificacion_partes($id){

        $objeto = Objeto::find($id);


        $partes = $objeto->partesObjeto();



        return view('catalogo.objetos.layout_clasificacion_partes',['objeto' => $objeto,'partes' => $partes]);

    }


    public function update_general_data(Request $request){
        $ref = $request->input('ref');
        $visible = $request->input('visible');
        $anyo = $request->input('anyo');
        $es_tumba = $request->input('es_tumba');
        $num_serie = $request->input('num_serie');
        $cronologia = $request->input('cronologia');
        $descripcion = $request->input('descripcion');
        $forma = $request->input('forma');
        $decoracion = $request->input('decoracion');
        $observaciones = $request->input('observaciones');
        $almacen = $request->input('almacen');



        if($request->has('ue')){

            $validator = Validator::make($request->all(), [
                'ue' => 'exists:unidadestratigrafica,ue'
                ]);

            if ($validator->fails()) {
                return redirect('/objeto_datos_generales/'.$ref)
                    ->withErrors($validator);
            }

            $ue = $request->input('ue');


        }else{

           $ue = NULL;

        }

        if($request->input('es_tumba') == 'No') {
            $tumba = NULL;

        }else{



            $validator = Validator::make($request->all(), [
                'tumba' => 'exists:tumba,idtumba'
            ]);

            if ($validator->fails()) {
                return redirect('/objeto_datos_generales/' . $ref)
                    ->withErrors($validator);
            }

            $tumba = $request->input('tumba');


            }







        $validator = Validator::make($request->all(), [

            'ref'        => 'required|exists:fichaobjeto,ref',
            'visible'    => 'required|in:' . implode(',', Config::get('enums.bool')) ,
            'anyo'       => 'integer|min:1970|max:' .date("Y") ,
            'es_tumba'   => 'in:' . implode(',', Config::get('enums.bool')),
            'num_serie'  => 'string',
            'cronologia' => 'string',
            'descripcion'=> 'string',
            'forma'      => 'string',
            'decoracion' => 'string',
            'observaciones' => 'string',
            'almacen'    => 'string',


        ]);

        if ($validator->fails()) {
            return redirect('/objeto_datos_generales/'.$ref)
                ->withErrors($validator);
        }



        DB::table('fichaobjeto')->where('ref','=',$ref)
            ->update(['visiblecatalogo' => $visible,'anyocampanya' => $anyo,'numeroserie' => $num_serie,
            'esTumba' => $es_tumba,'cronologia' => $cronologia,'descripcion' => $descripcion,'forma' => $forma,
            'decoracion' => $decoracion,'observaciones' => $observaciones,'almacen' => $almacen,'ue' => $ue,'idtumba' => $tumba]);


        return redirect('/objeto_datos_generales/'.$ref)->with('success','Datos generales actualizados correctamente');



    }

    public function get_materiales_objeto($id){

        $objeto = Objeto::find($id);


        $partes = $objeto->partesObjeto();

            return view('catalogo.objetos.layout_materiales_objeto',['objeto' => $objeto,'partes' => $partes ]);
    }


    public function get_material_objeto($ref,$id){




        $parte = ParteObjeto::find($id);
        $objeto = Objeto::find($ref);


        $partes_objeto = $objeto->partesObjeto();

        $asociados =  $parte->materialesAsociados();

        $no_asociados = $parte->materialesNoAsociados();

        return view('catalogo.objetos.layout_material_objeto',['objeto' => $objeto,'partes' => $partes_objeto,
            'asociados' => $asociados,'no_asociados' => $no_asociados, 'parte' => $parte ]);





    }

    public function get_localizacion($id){

        $objeto = Objeto::find($id);

        $localizaciones = DB::table('localizacion')->get();

        return view('catalogo.objetos.layout_localizacion',['objeto' => $objeto, 'localizaciones' => $localizaciones]);
    }

    public function asignar_localizacion(Request $request){
                $ref = $request->input('ref');
                $localizacion = $request->input('localizacion');

        $validator = Validator::make($request->all(), [
            'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
            'localizacion' => 'required|min:0|exists:localizacion,idlocalizacion',

        ]);

        if ($validator->fails()) {
            return redirect('/localizacion_objeto/'.$ref)->withErrors($validator);
        }


        DB::table('fichaobjeto')
            ->where('ref','=',$ref)
            ->update(['localizacion' => $localizacion]);

        return redirect('/localizacion_objeto/'.$ref)->with('success','Localizacion asignada con exito');




    }


}
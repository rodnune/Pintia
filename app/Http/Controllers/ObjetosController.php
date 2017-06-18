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



        $objeto = Objeto::find($id);

        $ues = DB::table('unidadestratigrafica')->orderBy('ue')->get();
        $tumbas = DB::table('tumba')->orderBy('idtumba')->get();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->all();
        $pendientes = collect($pendientes);

        return view('catalogo.objetos.layout_datos_gen',['objeto' => $objeto,'uds_estratigraficas' => $ues,'tumbas' => $tumbas,
            'seccion' => 'DatosGenerales','pendientes' => $pendientes]);


    }

    public function get_clasificacion_partes($id){

        $objeto = Objeto::find($id);


        $partes = $objeto->partesObjeto();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Clasificacion'])->all();
        $pendiente = collect($pendientes);






        return view('catalogo.objetos.layout_clasificacion_partes',['objeto' => $objeto,'partes' => $partes,'pendientes' => $pendiente]);

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

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['MaterialesObjeto'])->all();
        $pendiente = collect($pendientes);

            return view('catalogo.objetos.layout_materiales_objeto',['objeto' => $objeto,
                'partes' => $partes,'pendientes' => $pendiente]);
    }


    public function get_material_objeto($ref,$id){




        $parte = ParteObjeto::find($id);
        $objeto = Objeto::find($ref);


        $partes_objeto = $objeto->partesObjeto();

        $asociados =  $parte->materialesAsociados();

        $no_asociados = $parte->materialesNoAsociados();

        return view('catalogo.objetos.layout_material_objeto',['objeto' => $objeto,'partes' => $partes_objeto,
            'asociados' => $asociados,'no_asociados' => $no_asociados, 'parte' => $parte,'seccion' => 'MaterialesObjeto' ]);





    }

    public function get_localizacion($id){

        $objeto = Objeto::find($id);

        $localizaciones = DB::table('localizacion')->get();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Localizacion'])->all();
        $pendiente = collect($pendientes);

        return view('catalogo.objetos.layout_localizacion',['objeto' => $objeto, 'localizaciones' => $localizaciones,
        'pendientes' => $pendiente]);
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


    public function get_articulos($id){

        $objeto = Objeto::find($id);

        $asociados = $objeto->articulosAsociados();
        $no_asociados = $objeto->articulosNoAsociados();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Articulos'])->all();
        $pendiente = collect($pendientes);



        return view('catalogo.objetos.layout_articulos_objeto',['objeto' => $objeto,'asociados' => $asociados,
            'no_asociados' => $no_asociados,'pendientes' => $pendiente]);
    }


    public function gestion_articulos_objeto(Request $request)
    {

        $ref = $request->input('ref');

        $validator = Validator::make($request->all(), [
            'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
            'articulo' => 'required_without:eliminar|exists:articulos,idarticulo',
            'eliminar' => 'required_without:articulo|exists:articulos,idarticulo'

        ]);


        if ($request->submit == 'Asociar') {

            if ($validator->fails()) {
                return redirect('/articulos_objeto/' . $ref)->withErrors($validator);
            }

            $articulo = $request->input('articulo');

            DB::table('publicadoen')->insert(['ref' => $ref, 'idarticulo' => $articulo]);

            return redirect('/articulos_objeto/' . $ref)->with('success', 'Articulo asociado correctamente');

        }

        if ($request->submit == 'Eliminar') {


            if ($validator->fails()) {
                return redirect('/articulos_objeto/' . $ref)->withErrors($validator);
            }

            $articulo = $request->input('eliminar');

            DB::table('publicadoen')
                ->where('ref', '=', $ref)
                ->where('idarticulo', '=', $articulo)
                ->delete();

            return redirect('/articulos_objeto/' . $ref)->with('success', 'Asociacion eliminada correctamente');


        }
    }



        public function get_multimedias($id){
            $objeto = Objeto::find($id);
            $asociados = $objeto->multimediasAsociados();
            $no_asociados = $objeto->multimediasNoAsociados();

            $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Multimedia'])->all();
            $pendiente = collect($pendientes);

            return view('catalogo.objetos.layout_multimedia',['objeto' => $objeto,
                'asociados' => $asociados,'no_asociados' => $no_asociados,'pendientes' => $pendiente]);

        }


        public function gestion_multimedias_objeto(Request $request){



            $ref = $request->input('ref');


            $validator = Validator::make($request->all(), [
                'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
                'multimedia' => 'required_without:eliminar|exists:almacenmultimedia,idmutimedia',
                'eliminar' => 'required_without:multimedia|exists:almacenmultimedia,idmutimedia',
                'orden'   =>  'integer|min:0'

            ]);




            if($request->submit == "Asociar"){


                if ($validator->fails()) {
                    return redirect('/multimedias_objeto/' . $ref)->withErrors($validator);
                }


                $multimedia = $request->input('multimedia');
                $orden = $request->input('orden');

                DB::table('multimediaobjeto')->insert(['ref' => $ref, 'idmutimedia' => $multimedia,'orden' => $orden]);

                return redirect('/multimedias_objeto/' . $ref)->with('success', 'Multimedia asociado correctamente');


            }


            if($request->submit == "Eliminar"){


                if ($validator->fails()) {
                    return redirect('/multimedias_objeto/' . $ref)->withErrors($validator);
                }


                $multimedia = $request->input('eliminar');

                DB::table('multimediaobjeto')
                    ->where('ref','=',$ref)
                    ->where('idmutimedia','=',$multimedia)
                    ->delete();

                return redirect('/multimedias_objeto/' . $ref)->with('success', 'Asociacion multimedia eliminada correctamente');


            }

        }

        public function get_pendientes($id){

            $objeto = Objeto::find($id);
            $completados = $objeto->camposCompletados();
            $pendientes = $objeto->camposPendientes();




            return view('catalogo.objetos.layout_pendiente',['objeto' => $objeto,
                'completados' => $completados,'pendientes' => $pendientes]);

        }


        public function gestion_campos_pendientes(Request $request){


            $ref = $request->input('ref');


            $validator = Validator::make($request->all(), [
                'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
                'pendiente' => 'required_without:hecho|exists:camposobjeto,idcampo',
                'hecho' => 'required_without:pendiente|exists:camposobjeto,idcampo',

            ]);




            if($request->submit == "Asociar"){


                if ($validator->fails()) {
                    return redirect('/multimedias_objeto/' . $ref)->withErrors($validator);
                }


                $pendiente = $request->input('pendiente');

                DB::table('pendienteobjeto')->insert(['ref' => $ref, 'idcampo' => $pendiente]);

                return redirect('/pendientes_objeto/' . $ref)->with('success', 'Campo añadido a pendientes');


            }


            if($request->submit == "Eliminar"){


                if ($validator->fails()) {
                    return redirect('/multimedias_objeto/' . $ref)->withErrors($validator);
                }


                $hecho = $request->input('hecho');

                DB::table('pendienteobjeto')
                    ->where('ref','=',$ref)
                    ->where('idcampo','=',$hecho)
                    ->delete();

                return redirect('/pendientes_objeto/' . $ref)->with('success', 'Campo añadido a completados');


            }

        }


        public function add_nota(Request $request){
                   $ref = $request->input('ref');
                   $seccion = $request->input('seccion');
                   $nota = $request->input('nota');

            $validator = Validator::make($request->all(), [
                'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
                'seccion' => 'required|string',
                'nota' => 'required|string',

            ]);

            if ($validator->fails()) {
                return redirect('/objeto_datos_generales/' . $ref)->withErrors($validator);
            }

            $objeto = Objeto::find($ref);


            switch ($seccion) {
                case "DatosGenerales":

                    if(count($objeto->notaSeccion($seccion)) == 0){
                        return 'Insertar';
                    }
                   break;
                case "se corresponde con":

                    break;


            }



            //DB::table('notasobjeto')->



        }













}
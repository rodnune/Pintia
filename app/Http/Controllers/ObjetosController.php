<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 02/03/2017
 * Time: 11:24
 */

namespace app\Http\Controllers;

use App\Models\ParteObjeto;
use App\Models\Objeto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\UnidadEstratigrafica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;
use Config;
use Carbon\Carbon;
use URL;
use View;
use App;

class ObjetosController extends \App\Http\Controllers\Controller
{

    public function index()
    {


        $subcategorias = DB::table('categoria')->leftJoin('subcategoria', 'subcategoria.idcat', '=', 'categoria.idcat')
            ->select('categoria.denominacion as denominacioncat', 'subcategoria.denominacion as denominacionsubcat', 'categoria.idcat', 'subcategoria.idsubcat')
            ->get();


        $grouped = $subcategorias->groupBy('idcat');

        $categorias = $grouped->toArray();


        $materiales = DB::table('materiaprima')->orderBy('denominacion')->get();

        $localizaciones = DB::table('localizacion')->get();

        $materiales_grouped = DB::table('materialobjeto')
            ->join('parteobjeto', 'materialobjeto.idparte', '=', 'parteobjeto.idparte')
            ->join('materiaprima', 'materialobjeto.idmat', '=', 'materiaprima.idmat')
            ->select(DB::raw('DISTINCT(materialobjeto.IdMat)'), 'materiaprima.Denominacion', 'parteobjeto.IdParte', 'parteobjeto.Ref as Ref')
            ->get();


        $materiales_objeto = $materiales_grouped->groupBy('Ref');

        $ues = UnidadEstratigrafica::all();


        if (Session::get('admin_level') > 0) {

            $objetos = Objeto::getObjetos();

        } else {
          
                $objetos = Objeto::getObjetosVisibles();

        }



        return view('catalogo.objetos.layout_objetos', ['categorias' => $categorias,
            'materiales' => $materiales, 'localizaciones' => $localizaciones, 'objetos' => $objetos, 'materiales_objeto' => $materiales_objeto,'ues' => $ues]);

    }

    public function get_data($id){
        $objeto = Objeto::find($id);



        $partes = collect($objeto->partesobjeto()->keyBy('IdParte')->all());

        $multimedias = $objeto->multimediasAsociados();
        $articulos    = $objeto->articulosAsociados();
        $localizacion = $objeto->localizacion();
        $medidas = $objeto->medidasObjeto();
        $materiales = $objeto->materialesObjeto();
        $categorias = collect();
        $subcategorias = collect();




        foreach($partes as $parte) {


            if (is_null($parte->idCat)) {
                $categorias->put($parte->idCat, null);

            } else {
                $categorias->put($parte->idCat, Categoria::find($parte->idCat));
            }

            if (is_null($parte->IdSubcat)) {
                $subcategorias->put($parte->IdSubcat, null);

            } else {
                $subcategorias->put($parte->IdSubcat, Subcategoria::find($parte->IdSubcat));
            }

        }



        return array('objeto' => $objeto,'partes' => $partes,'categorias' => $categorias,
            'subcategorias' => $subcategorias,'multimedias' => $multimedias,
            'articulos' => $articulos,'localizacion' => $localizacion,'medidas' => $medidas,'materiales' => $materiales);

    }


    public function search(Request $request,Objeto $objeto)
    {


        $_REQUEST['tipo'] = explode("-", $request->input('tipo'));

        $datos_consulta = collect();

        $objetos = $objeto->newQuery();

        if ($request->has('tipo')) {


            if (count($_REQUEST['tipo']) == 1) {
                $objetos->whereIn('ref', function ($q) {
                    $q->select('parteobjeto.ref')->from('parteobjeto')
                        ->where('parteobjeto.idcat', '=', $_REQUEST['tipo'][0]);

                });

                $categoria = DB::table('categoria')->where('idcat','=', $_REQUEST['tipo'][0])->get()->first();
                $datos_consulta->put('categoria', $categoria->Denominacion);
            } else {

                $objetos->whereIn('ref', function ($q) {
                    $q->select('parteobjeto.ref')->from('parteobjeto')
                        ->where('parteobjeto.idcat', '=', $_REQUEST['tipo'][0])
                         ->where('parteobjeto.idsubcat', '=',$_REQUEST['tipo'][1]);

                });

                $categoria = DB::table('categoria')->where('idcat','=', $_REQUEST['tipo'][0])->get()->first();
                $subcategoria = DB::table('subcategoria')
                    ->where('idcat','=', $_REQUEST['tipo'][0])
                    ->where('idsubcat','=',$_REQUEST['tipo'][1])
                    ->get()->first();

                $datos_consulta->put('categoria', $categoria->Denominacion);
                $datos_consulta->put('subcategoria', $subcategoria->Denominacion);
            }
        }


        if ($request->has('lugar')) {

                $objetos->where('localizacion','=',$request->input('lugar'));

            $localizacion = DB::table('localizacion')->where('idlocalizacion','=',$_REQUEST['lugar'])->get()->first();

            $datos_consulta->put('sectortrama',$localizacion->SectorTrama);
            $datos_consulta->put('sectorsubtrama',$localizacion->SectorSubtrama);
            }

            if ($request->has('ue')) {

                $objetos->where('ue','=',$request->input('ue'));
                $datos_consulta->put('ue',$request->input('ue'));
            }

            if($request->has('material')){



                $objetos->whereIn('ref',function($q) {
                    $q->select('parteobjeto.ref')->from('parteobjeto')
                        ->whereIn('parteobjeto.idparte', function ($q2) {
                            $q2->select('materialobjeto.idparte')->from('materialobjeto')
                                ->where('materialobjeto.idmat', '=', $_REQUEST['material']);




                        });
                });


                $material = DB::table('materiaprima')->where('idmat','=',$_REQUEST['material'])->first();
                $datos_consulta->put('material',$material->Denominacion);


                }

                if($request->has('ref')){
                    $objetos->where('ref',$request->input('ref'));
                    $datos_consulta->put('referencia',$request->input('ref'));



                }





        if (Session::get('admin_level') >= 0) {
            $objetos = $objetos->leftJoin('site_user', function ($join) {
                $join->on('fichaobjeto.user_id', '=', 'site_user.user_id')
                    ->select('fichaobjeto.*','site_user.admin_level')
                    ->orderBy('fichaobjeto.ref');

            })
                ->get();


        } else {
            $objetos = $objetos->where('visiblecatalogo','=','Si')->get();
        }


      return  ObjetosController::index()->with(['datos' => $datos_consulta,'objetos' => $objetos]);


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



      $objeto = ObjetosController::get_data($id);



       return view('catalogo.objetos.layout_objeto',['objeto' => $objeto['objeto'],'partes' => $objeto['partes'],'categorias' => $objeto['categorias'],
           'subcategorias' => $objeto['subcategorias'],'multimedias' => $objeto['multimedias'],
           'articulos' => $objeto['articulos'],'localizacion' => $objeto['localizacion'],'medidas' => $objeto['medidas']
           ,'materiales' => $objeto['materiales']]);

    }


    public function delete(Request $request){

        $ref = $request->input('ref');

        $validator = Validator::make($request->all(), [

            'ref'        => 'required|exists:fichaobjeto,ref',


        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())
                ->withErrors($validator);
        }

        DB::table('fichaobjeto')
            ->where('ref','=',$ref)
            ->delete();

        return redirect('/objetos')->with('success','Objetos con referencia: '.$ref.' eliminado correctamente');
    }



    public function get_datos($id){

        $objeto = Objeto::find($id);



        $ues = DB::table('unidadestratigrafica')->orderBy('ue')->get();
        $tumbas = DB::table('tumba')->orderBy('idtumba')->get();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->all();
        $pendientes = collect($pendientes);



        $nota = $objeto->notaSeccion('Datos Generales');

        return view('catalogo.objetos.layout_datos_gen',['objeto' => $objeto,'uds_estratigraficas' => $ues,'tumbas' => $tumbas,
            'seccion' => 'DatosGenerales','pendientes' => $pendientes,'nota' => $nota]);


    }

    public function get_clasificacion_partes($id){

        $objeto = Objeto::find($id);


        $partes = $objeto->partesObjeto();


        $nota = $objeto->notaSeccion('Clasificacion y Partes');

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Clasificacion'])->all();
        $pendiente = collect($pendientes);






        return view('catalogo.objetos.layout_clasificacion_partes',['objeto' => $objeto,
            'partes' => $partes,'pendientes' => $pendiente,'nota' => $nota]);

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
                return redirect(URL::previous())
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
                return redirect(URL::previous())
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
            return redirect(URL::previous())
                ->withErrors($validator);
        }



        DB::table('fichaobjeto')->where('ref','=',$ref)
            ->update(['visiblecatalogo' => $visible,'anyocampanya' => $anyo,'numeroserie' => $num_serie,
            'esTumba' => $es_tumba,'cronologia' => $cronologia,'descripcion' => $descripcion,'forma' => $forma,
            'decoracion' => $decoracion,'observaciones' => $observaciones,'almacen' => $almacen,'ue' => $ue,'idtumba' => $tumba]);


        return redirect('/objeto/'.$ref.'/datos_generales')->with('success','Datos generales actualizados correctamente');



    }

    public function get_materiales_objeto($id){

        $objeto = Objeto::find($id);

        $nota = $objeto->notaSeccion('Materiales Objeto');


        $partes = $objeto->partesObjeto();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['MaterialesObjeto'])->all();
        $pendiente = collect($pendientes);

            return view('catalogo.objetos.layout_materiales_objeto',['objeto' => $objeto,
                'partes' => $partes,'pendientes' => $pendiente,'nota' => $nota]);
    }


    public function get_material_objeto($ref,$id){




        $parte = ParteObjeto::find($id);
        $objeto = Objeto::find($ref);



        $partes_objeto = $objeto->partesObjeto();

        $asociados =  $parte->materialesAsociados();

        $no_asociados = $parte->materialesNoAsociados();

        $nota = $objeto->notaSeccion('Materiales Objeto');

        return view('catalogo.objetos.layout_material_objeto',['objeto' => $objeto,'partes' => $partes_objeto,
            'asociados' => $asociados,'no_asociados' => $no_asociados, 'parte' => $parte,'nota' => $nota ]);





    }

    public function get_localizacion($id){

        $objeto = Objeto::find($id);

        $localizaciones = DB::table('localizacion')->get();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Localizacion'])->all();
        $pendiente = collect($pendientes);

        $nota = $objeto->notaSeccion('Localizacion');

        return view('catalogo.objetos.layout_localizacion',['objeto' => $objeto, 'localizaciones' => $localizaciones,
        'pendientes' => $pendiente,'nota' => $nota]);
    }

    public function asignar_localizacion(Request $request){
                $ref = $request->input('ref');
                $localizacion = $request->input('localizacion');

        $validator = Validator::make($request->all(), [
            'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
            'localizacion' => 'required|min:0|exists:localizacion,idlocalizacion',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }


        DB::table('fichaobjeto')
            ->where('ref','=',$ref)
            ->update(['localizacion' => $localizacion]);

        return redirect('/objeto/'.$ref.'/localizacion')->with('success','Localizacion asignada con exito');


    }


    public function get_articulos($id){

        $objeto = Objeto::find($id);

        $asociados = $objeto->articulosAsociados();
        $no_asociados = $objeto->articulosNoAsociados();

        $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Articulos'])->all();
        $pendiente = collect($pendientes);

        $nota = $objeto->notaSeccion('Articulos');



        return view('catalogo.objetos.layout_articulos_objeto',['objeto' => $objeto,'asociados' => $asociados,
            'no_asociados' => $no_asociados,'pendientes' => $pendiente,'nota' => $nota]);
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
                return redirect(URL::previous())->withErrors($validator);
            }

            $articulo = $request->input('articulo');

            DB::table('publicadoen')->insert(['ref' => $ref, 'idarticulo' => $articulo]);

            return redirect('/objeto/' . $ref .'/articulos')->with('success', 'Articulo asociado correctamente');

        }

        if ($request->submit == 'Eliminar') {


            if ($validator->fails()) {
                return redirect('/objeto/' . $ref .'/articulos')->withErrors($validator);
            }

            $articulo = $request->input('eliminar');

            DB::table('publicadoen')
                ->where('ref', '=', $ref)
                ->where('idarticulo', '=', $articulo)
                ->delete();

            return redirect('/objeto/' . $ref .'/articulos')->with('success', 'Asociacion eliminada correctamente');


        }
    }



        public function get_multimedias($id){
            $objeto = Objeto::find($id);
            $asociados = $objeto->multimediasAsociados();
            $no_asociados = $objeto->multimediasNoAsociados();

            $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['Multimedia'])->all();
            $pendiente = collect($pendientes);

            $nota = $objeto->notaSeccion('Multimedia');

            return view('catalogo.objetos.layout_multimedia',['objeto' => $objeto,
                'asociados' => $asociados,'no_asociados' => $no_asociados,'pendientes' => $pendiente,'nota' => $nota]);

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
                    return redirect(URL::previous())->withErrors($validator);
                }


                $multimedia = $request->input('multimedia');
                $orden = $request->input('orden');

                DB::table('multimediaobjeto')->insert(['ref' => $ref, 'idmutimedia' => $multimedia,'orden' => $orden]);

                return redirect('/objeto/'.$ref.'/multimedias')->with('success', 'Multimedia asociado correctamente');


            }


            if($request->submit == "Eliminar"){


                if ($validator->fails()) {
                    return redirect(URL::previous())->withErrors($validator);
                }


                $multimedia = $request->input('eliminar');

                DB::table('multimediaobjeto')
                    ->where('ref','=',$ref)
                    ->where('idmutimedia','=',$multimedia)
                    ->delete();

                return redirect('/objeto/'.$ref.'/multimedias')->with('success', 'Asociacion multimedia eliminada correctamente');


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
                    return redirect(URL::previous())->withErrors($validator);
                }


                $pendiente = $request->input('pendiente');

                DB::table('pendienteobjeto')->insert(['ref' => $ref, 'idcampo' => $pendiente]);

                return redirect('/objeto/'.$ref.'/pendientes')->with('success', 'Campo añadido a pendientes');


            }


            if($request->submit == "Eliminar"){


                if ($validator->fails()) {
                    return redirect(URL::previous())->withErrors($validator);
                }


                $hecho = $request->input('hecho');

                DB::table('pendienteobjeto')
                    ->where('ref','=',$ref)
                    ->where('idcampo','=',$hecho)
                    ->delete();

                return redirect('/objeto/'.$ref.'/pendientes')->with('success', 'Campo añadido a completados');


            }

        }




        public function get_notas($id){

            $objeto = Objeto::find($id);

            return view('catalogo.objetos.layout_notas',['objeto' => $objeto]);

        }


    public function add_nota(Request $request)
    {
        $ref = $request->input('ref');
        $seccion = $request->input('seccion');
        $contenido = $request->input('nota');

        $validator = Validator::make($request->all(), [
            'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
            'seccion' => 'required',
            'nota' => 'required|string',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

       $nota_seccion = ObjetosController::get_nota_seccion($ref,$seccion,$request);


        if(count($nota_seccion) == 0){
            DB::table('notasobjeto')->insert(['ref' => $ref,'seccion' => $seccion,'contenido' => $contenido]);
        }else {
            DB::table('notasobjeto')
                ->where('ref','=',$ref)
                ->where('seccion','=',$seccion)
                ->update(['contenido' => $contenido]);
        }

        return redirect('/objeto/' . $ref. '/notas')->with('success','Notada guardada correctamente');



        }

        public function get_nota_seccion($id,$seccion,Request $request){


          $objeto = Objeto::find($id);

          $nota_seccion = $objeto->notaSeccion($seccion);



            if($request->ajax()){
                return json_encode($nota_seccion);
            }else{
                return $nota_seccion;
            }

        }





}
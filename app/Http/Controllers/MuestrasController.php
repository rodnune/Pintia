<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 30/03/2017
 * Time: 23:53
 */

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use App\Models\Muestra;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Lang;
use URL;

class MuestrasController extends \App\Http\Controllers\Controller
{

    public function index(Request $request){

                    $tipos = DB::table('tiposmuestra')->orderBy('denominacion','asc')->get();
                    $muestras = DB::table('muestras')
                        ->leftJoin('muestraesdetipo','muestras.NumeroRegistro','=','muestraesdetipo.NumeroRegistro')
                        ->leftJoin('tiposmuestra','tiposmuestra.IdTipoMuestra','=','muestraesdetipo.IdTipoMuestra')
                        ->select('tiposmuestra.denominacion','muestras.*')->get();

                    $grouped = $muestras->groupBy('NumeroRegistro');
                    $array = $grouped->toArray();

                    return view('catalogo.muestras.layout_muestras',['tipos'=>$tipos,'muestras' => $array]);

    }

    public function search(Request $request){

        $consulta = collect();

        if($request->has('tipo')){

            $tipo = $request->input('tipo');
            $muestras = DB::table('muestraesdetipo')
                ->join('muestras','muestras.NumeroRegistro','=','muestraesdetipo.NumeroRegistro')
                ->join('tiposmuestra','tiposmuestra.IdTipoMuestra','=','muestraesdetipo.IdTipoMuestra')
                ->where('tiposmuestra.IdTipoMuestra',$tipo)
                ->select('tiposmuestra.denominacion','muestras.*')->get();

            $muestra = DB::table('tiposmuestra')->where('idtipomuestra','=',$tipo)->first();

            $consulta->put('tipo',$muestra->Denominacion);

            $grouped = $muestras->groupBy('NumeroRegistro');

            $array = $grouped->toArray();

            $tipos = DB::table('tiposmuestra')->orderBy('denominacion','asc')->get();
        }


        return view('catalogo.muestras.layout_muestras',['tipos'=>$tipos,'muestras' => $array,'datos' => $consulta]);

    }

    public function create(Request $request){
             $registro = $request->input('registro');
             $notas = $request->input('notas');

        $validator = Validator::make($request->all(), [



            'registro' => 'required|numeric|min:0|unique:muestras,NumeroRegistro',
        ]);

        if ($validator->fails()) {
            return redirect('/new_muestra')
                ->withErrors($validator);
        }

        DB::table('muestras')->insert(['NumeroRegistro' => $registro ,'Notas' => $notas]);



        return redirect('/muestras')->with('success','Muestra con numero de registro: '.$registro.' creada correctamente');
    }


    public function delete(Request $request){
                $registro = $request ->input('registro');

        DB::table('muestras')->where('NumeroRegistro', '=', $registro)->delete();

        return redirect('/muestras')
            ->with('success','Muestra con numero de registro: '.$registro.' borrada correctamente');
    }

    public function get($id){

       $muestra      =  Muestra::find($id);
       $asociados    = $muestra->tiposMuestrasAsociados();
       $no_asociados = $muestra->tiposMuestraNoAsociados();


        return view('catalogo.muestras.layout_update_muestra',['muestra' => $muestra,'asociados' => $asociados,'no_asociados' => $no_asociados ]);
    }

    public function update(Request $request){
        $registro = $request ->input('id');
        $new_registro = $request -> input('registro');
        $notas = $request -> input('notas');

        $validator = Validator::make($request->all(), [



            'registro' => 'required|numeric|min:0|unique:muestras,numeroregistro,'.$registro.',numeroregistro',
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())
                ->withErrors($validator);
        }

                DB::table('muestras')
                    ->where('NumeroRegistro',$registro)
                    ->update(['NumeroRegistro' => $new_registro,'Notas' => $notas ]);

                return redirect('/muestra/'.$new_registro)->with('success','Muestra actualizada correctamente');
    }

    public function eliminarAsociacion(Request $request){
                $id = $request->input('id');
                $muestra = $request->input('muestra');

        $validator = Validator::make($request->all(), [
            'id'      => 'required|exists:muestras,numeroregistro',
            'muestra' => 'required|exists:tiposmuestra,idtipomuestra'
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())
                ->withErrors($validator);
        }

                DB::table('muestraesdetipo')
                    ->where('NumeroRegistro','=',$id)
                    ->where('IdTipoMuestra','=',$muestra)
                    ->delete();

                return redirect(URL::previous())->with('success',Lang::get('messages.asociacion_eliminada'));
    }

    public function addAsociacion(Request $request){
        $id = $request->input('id');
        $muestra = $request->input('muestra');

        $validator = Validator::make($request->all(), [


            'id'      => 'required|exists:muestras,numeroregistro',
            'muestra' => 'required|exists:tiposmuestra,idtipomuestra'
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())
                ->withErrors($validator);
        }

        DB::table('muestraesdetipo')->insert(['NumeroRegistro' => $id , 'IdTipoMuestra' => $muestra]);

        return redirect(URL::previous())->with('success','Tipo de muestra asociado correctamente');
    }



    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
        $no_asociadas = $ud_estratigrafica->muestrasNoAsociadas();
        $asociadas = $ud_estratigrafica->muestrasAsociadas();
        $pendientes = $ud_estratigrafica->camposPendientes()->keyBy('NombreCampo')->only(['Muestras'])->all();
        $pendiente = collect($pendientes);
        $nota = $ud_estratigrafica->notaSeccion('Muestras');

        return view('catalogo.uds_estratigraficas.layout_muestras', ['ud_estratigrafica' => $ud_estratigrafica,
            'asociadas' => $asociadas,'no_asociadas' => $no_asociadas,'pendiente' => $pendiente,'nota' => $nota]);
    }

    public function asociarUE(Request $request){


        $id_ue = $request ->input('id');
        $id_muestra = $request ->input('add');

        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:unidadestratigrafica,ue',
            'add' => 'required|exists:muestras,numeroregistro',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('muestrasue')->insert(['NumeroRegistro' => $id_muestra,'UE' => $id_ue]);

        return redirect('/ud_estratigrafica/'.$id_ue.'/muestras')->with('success','Muestra asociada correctamente');
    }

    public function eliminarAsociacionUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('delete');

        $validator = Validator::make($request->all(), [
            'id'        => 'required|exists:unidadestratigrafica,ue',
            'delete' => 'required|exists:muestras,numeroregistro',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }
        DB::table('muestrasue')->where(
            'NumeroRegistro','=',$id_componente)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica/'.$id_ue.'/muestras')->with('success',Lang::get('messages.asociacion_eliminada'));
    }

    public function get_tipos(){
       $tipos = DB::table('tiposmuestra')->orderBy('denominacion')->get();

        return view('gestion.listas.layout_muestras',['tipos' => $tipos]);
    }

    public function gestionar(Request $request){
        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:tiposmuestra,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_tipos_muestra')->withErrors($validator);
            }
            DB::table('tiposmuestra')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_tipos_muestra')->with('success','Tipo de muestra: '.$keyword.' creada correctamente');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:tiposmuestra,idtipomuestra',
                'reemplazar' => 'required|unique:tiposmuestra,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_tipos_muestra')->withErrors($validator);
            }

         $tipo_muestra =   DB::table('tiposmuestra')
                ->where('idtipomuestra','=',$keyword)->first();

            DB::table('tiposmuestra')
                ->where('idtipomuestra','=',$keyword)
                ->update(['denominacion' => $keyword_update]);


            return redirect('/gestion_tipos_muestra')
                ->with('success','Tipo de muestra: '.$tipo_muestra->Denominacion. ' actualizada correctamente');
        }


        if($request->submit == 'Borrar'){
            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:tiposmuestra,idtipomuestra',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_tipos_muestra')->withErrors($validator);
            }

            $tipo_muestra =   DB::table('tiposmuestra')
                ->where('idtipomuestra','=',$keyword)->first();

            DB::table('tiposmuestra')
                ->where('idtipomuestra','=',$keyword)
                ->delete();


            return redirect('/gestion_tipos_muestra')
                ->with('success','Tipo de muestra: '.$tipo_muestra->Denominacion. ' borrada correctamente');
        }
    }



}
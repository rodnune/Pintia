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

class MuestrasController extends \App\Http\Controllers\Controller
{

    public function index(Request $request){
                if(!$request->has('tipo')){
                    $tipos = DB::table('tiposmuestra')->orderBy('denominacion','asc')->get();
                    $muestras = DB::table('muestras')
                        ->leftJoin('muestraesdetipo','muestras.NumeroRegistro','=','muestraesdetipo.NumeroRegistro')
                        ->leftJoin('tiposmuestra','tiposmuestra.IdTipoMuestra','=','muestraesdetipo.IdTipoMuestra')
                        ->select('tiposmuestra.denominacion','muestras.*')->get();


                    $grouped = $muestras->groupBy('NumeroRegistro');

                    $array = $grouped->toArray();




                    return view('catalogo.muestras.layout_muestras',['tipos'=>$tipos,'muestras' => $array]);
                } else {
                    $tipo = $request->input('tipo');

                    $tipos = DB::table('tiposmuestra')->orderBy('denominacion','asc')->get();
                    $muestras = DB::table('muestraesdetipo')
                        ->join('muestras','muestras.NumeroRegistro','=','muestraesdetipo.NumeroRegistro')
                        ->join('tiposmuestra','tiposmuestra.IdTipoMuestra','=','muestraesdetipo.IdTipoMuestra')
                        ->where('tiposmuestra.IdTipoMuestra',$tipo)
                        ->select('tiposmuestra.denominacion','muestras.*')->get();


                    $grouped = $muestras->groupBy('NumeroRegistro');

                    $array = $grouped->toArray();



                    return view('catalogo.muestras.layout_muestras',['tipos'=>$tipos,'muestras' => $array]);
                }

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



        return redirect('/muestras');
    }


    public function delete(Request $request){
                $registro = $request ->input('registro');

        DB::table('muestras')->where('NumeroRegistro', '=', $registro)->delete();

        return redirect('/muestras');
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



            'registro' => 'required|numeric|min:0|unique:muestras,NumeroRegistro',
        ]);

        if ($validator->fails()) {
            return redirect('/muestra/'.$registro)
                ->withErrors($validator);
        }

                DB::table('muestras')
                    ->where('NumeroRegistro',$registro)
                    ->update(['NumeroRegistro' => $new_registro,'Notas' => $notas ]);

                return redirect('/muestra/'.$new_registro);
    }

    public function eliminarAsociacion(Request $request){
                $id = $request->input('id');
                $muestra = $request->input('muestra');

        $validator = Validator::make($request->all(), [



            'muestra' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/muestra/'.$id)
                ->withErrors($validator);
        }

                DB::table('muestraesdetipo')
                    ->where('NumeroRegistro','=',$id)
                    ->where('IdTipoMuestra','=',$muestra)
                    ->delete();

                return redirect('/muestra/'.$id);
    }

    public function addAsociacion(Request $request){
        $id = $request->input('id');
        $muestra = $request->input('muestra');

        $validator = Validator::make($request->all(), [



            'muestra' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/muestra/'.$id)
                ->withErrors($validator);
        }

        DB::table('muestraesdetipo')->insert(['NumeroRegistro' => $id , 'IdTipoMuestra' => $muestra]);

        return redirect('/muestra/'.$id);
    }



    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociadas = $ud_estratigrafica->muestrasNoAsociadas();


        $asociadas = $ud_estratigrafica->muestrasAsociadas();

        return view('catalogo.uds_estratigraficas.layout_muestras', ['ud_estratigrafica' => $ud_estratigrafica, 'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);
    }

    public function asociarUE(Request $request){
        $id_ue = $request ->input('id');
        $id_muestra = $request ->input('add');
        DB::table('muestrasue')->insert(['NumeroRegistro' => $id_muestra,'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_muestras/'.$id_ue);
    }

    public function eliminarAsociacionUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('delete');

        /*
         * Doble condicion where
         */
        DB::table('muestrasue')->where(
            'NumeroRegistro','=',$id_componente)
            ->where('UE', '=', $id_ue)


            ->delete();

        return redirect('/ud_estratigrafica_muestras/'.$id_ue);
    }

}
<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class CGeologicosController extends \App\Http\Controllers\Controller

{

    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
        $asociados = $ud_estratigrafica-> componentesGeologicosAsociados();
        $no_asociados = $ud_estratigrafica-> componentesGeologicosNoAsociados();


        return view('catalogo.uds_estratigraficas.layout_cgeologicos',['ud_estratigrafica' => $ud_estratigrafica, 'asociados' => $asociados,'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('add');
        DB::table('cgeologicosue')->insert(['IdCGeologico' => $id_componente,'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_cgeologicos/'.$id_ue);
        }

    public function eliminarAsociacionUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('id_geo_delete');

        /*
         * Doble condicion where
         */
        DB::table('cgeologicosue')->where(
            'IdCGeologico','=',$id_componente)
            ->where('UE', '=', $id_ue)


        ->delete();

        return redirect('/ud_estratigrafica_cgeologicos/'.$id_ue);
    }

    public function get(){
        $geologicos = DB::table('componentesgeologicos')->orderBy('denominacion')->get();

        return view('gestion.listas.layout_comp_geologicos', ['geologicos' => $geologicos]);
    }

    public function gestionar(Request $request){

        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:componentesgeologicos,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_geologicos')->withErrors($validator);
            }
            DB::table('componentesgeologicos')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_geologicos');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:componentesgeologicos,idcgeologico',
                'reemplazar' => 'required|unique:componentesgeologicos,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_geologicos')->withErrors($validator);
            }

            DB::table('componentesgeologicos')
                ->where('idcgeologico','=',$keyword)
                ->update(['denominacion' => $keyword_update]);


            return redirect('/gestion_geologicos');
        }


        if($request->submit == 'Borrar'){

            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:componentesgeologicos,idcgeologico',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_geologicos')->withErrors($validator);
            }

            DB::table('componentesgeologicos')
                ->where('idcgeologico','=',$keyword)
                ->delete();


            return redirect('/gestion_geologicos');
        }




    }

}
<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class ArtefactosController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
        $asociados = $ud_estratigrafica->artefactosAsociados();
        $no_asociados = $ud_estratigrafica->artefactosNoAsociados();

        return view('catalogo.uds_estratigraficas.layout_artefactos', ['ud_estratigrafica' => $ud_estratigrafica, 'asociados' => $asociados, 'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_superficie = $request->input('add');
        DB::table('fosilesue')->insert(['IdFosil' => $id_superficie, 'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_artefactos/' . $id_ue);
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_superficie = $request->input('delete');

        /*
         * Doble condicion where
         */
        DB::table('fosilesue')->where(
            'IdFosil', '=', $id_superficie)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica_artefactos/' . $id_ue);
    }


    public function get(){
       $artefactos =  DB::table('fosiles')->orderBy('denominacion')->get();

       return view('gestion.listas.layout_artefactos',['artefactos' => $artefactos]);


    }

    public function gestionar(Request $request){
        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:fosiles,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_artefactos')->withErrors($validator);
            }
            DB::table('fosiles')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_artefactos');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:fosiles,idfosil',
                'reemplazar' => 'required|unique:fosiles,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_artefactos')->withErrors($validator);
            }

            DB::table('fosiles')
                ->where('idfosil','=',$keyword)
                ->update(['denominacion' => $keyword_update]);


            return redirect('/gestion_artefactos');
        }


        if($request->submit == 'Borrar'){

            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:fosiles,idfosil',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_artefactos')->withErrors($validator);
            }

            DB::table('fosiles')
                ->where('idfosil','=',$keyword)
                ->delete();


            return redirect('/gestion_artefactos');
        }

    }
}
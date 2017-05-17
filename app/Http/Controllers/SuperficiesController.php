<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class SuperficiesController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
        $asociados = $ud_estratigrafica->superficiesAsociadas();
        $no_asociados = $ud_estratigrafica->superficiesNoAsociadas();


        return view('catalogo.uds_estratigraficas.layout_superficies', ['ud_estratigrafica' => $ud_estratigrafica, 'asociados' => $asociados, 'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_superficie = $request->input('add');
        DB::table('superficiesue')->insert(['IdSuperficie' => $id_superficie, 'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_superficies/' . $id_ue);
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_superficie = $request->input('delete');

        /*
         * Doble condicion where
         */
        DB::table('superficiesue')->where(
            'IdSuperficie', '=', $id_superficie)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica_superficies/' . $id_ue);
    }

    public function get(){
       $superficies = DB::table('superficies')->orderBy('denominacion')->get();

       return view('gestion.layout_superficies',['superficies' => $superficies]);
    }

    public function gestionar(Request $request){

        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:superficies,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_superficies')->withErrors($validator);
            }
            DB::table('superficies')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_superficies');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:superficies,idsuperficie',
                'reemplazar' => 'required|unique:superficies,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_superficies')->withErrors($validator);
            }

            DB::table('superficies')
                ->where('idsuperficie','=',$keyword)
                ->update(['denominacion' => $keyword_update]);


            return redirect('/gestion_superficies');
        }


        if($request->submit == 'Borrar'){

            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:superficies,idsuperficie',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_superficies')->withErrors($validator);
            }

            DB::table('superficies')
                ->where('idsuperficie','=',$keyword)
                ->delete();


            return redirect('/gestion_superficies');
        }

    }
}

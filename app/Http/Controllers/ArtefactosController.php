<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Lang;
use URL;

class ArtefactosController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
        $asociados = $ud_estratigrafica->artefactosAsociados();
        $no_asociados = $ud_estratigrafica->artefactosNoAsociados();
        $pendientes = $ud_estratigrafica->camposPendientes()->keyBy('NombreCampo')->only(['Artefactos'])->all();
        $pendiente = collect($pendientes);
        $nota = $ud_estratigrafica->notaSeccion('Artefactos');

        return view('catalogo.uds_estratigraficas.layout_artefactos',
            ['ud_estratigrafica' => $ud_estratigrafica, 'asociados' => $asociados,
                'no_asociados' => $no_asociados,'pendiente' => $pendiente,'nota' => $nota]);

    }

    public function asociarUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_superficie = $request->input('add');

        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',
            'add'  => 'required|exists:fosiles,idfosil',

        ]);


        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('fosilesue')->insert(['IdFosil' => $id_superficie, 'UE' => $id_ue]);

        return redirect('/ud_estratigrafica/' . $id_ue .'/artefactos')->with('success','Artefacto asociado correctamente');
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_superficie = $request->input('delete');

        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',
            'delete'  => 'required|exists:fosiles,idfosil',

        ]);


        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }
        DB::table('fosilesue')->where(
            'IdFosil', '=', $id_superficie)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica/' . $id_ue.'/artefactos')
            ->with('success',Lang::get('messages.asociacion_eliminada'));
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
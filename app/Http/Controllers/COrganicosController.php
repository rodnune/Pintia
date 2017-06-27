<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Lang;
use URL;

class COrganicosController extends \App\Http\Controllers\Controller

{

    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
        $asociados = $ud_estratigrafica->componentesOrganicosAsociados();
        $no_asociados = $ud_estratigrafica -> componentesOrganicosNoAsociados();

        $pendientes = $ud_estratigrafica->camposPendientes()->keyBy('NombreCampo')->only(['CompOrganicos'])->all();
        $pendiente = collect($pendientes);
        $nota = $ud_estratigrafica->notaSeccion('Componentes Organicos');



        return view('catalogo.uds_estratigraficas.layout_corganicos',
            ['ud_estratigrafica' => $ud_estratigrafica,
                'asociados' => $asociados,'no_asociados' => $no_asociados,'pendiente' => $pendiente,'nota' => $nota]);

    }

    public function asociarUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('add');

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:unidadestratigrafica,ue',
            'add' => 'required|exists:componentesorganicos,idcorganico',
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('corganicosue')->insert(['IdCOrganico' => $id_componente,'UE' => $id_ue]);

        return redirect('/ud_estratigrafica/'.$id_ue.'/organicos')->with('success','Componente organico asociado correctamente');
    }

    public function eliminarAsociacionUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('delete');

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:unidadestratigrafica,ue',
            'delete' => 'required|exists:componentesorganicos,idcorganico',
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('corganicosue')->where(
            'IdCOrganico','=',$id_componente)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica/'.$id_ue.'/organicos')->with('success',Lang::get('messages.asociacion_eliminada'));
    }

    public function  get(){
       $organicos = DB::table('componentesorganicos')->orderBy('denominacion')->get();

       return view('gestion.listas.layout_comp_organicos',['organicos' => $organicos]);
    }

    public function gestionar(Request $request){

        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:componentesorganicos,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_organicos')->withErrors($validator);
            }
            DB::table('componentesorganicos')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_organicos');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:componentesorganicos,idcorganico',
                'reemplazar' => 'required|unique:componentesorganicos,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_organicos')->withErrors($validator);
            }

            DB::table('componentesorganicos')
                ->where('idcorganico','=',$keyword)
                ->update(['denominacion' => $keyword_update]);


            return redirect('/gestion_organicos');
        }


        if($request->submit == 'Borrar'){

            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:componentesorganicos,idcorganico',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_organicos')->withErrors($validator);
            }

            DB::table('componentesorganicos')
                ->where('idcorganico','=',$keyword)
                ->delete();


            return redirect('/gestion_organicos');
        }


    }

}
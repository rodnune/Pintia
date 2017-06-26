<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Lang;
use Validator;


class CArtificialesController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $asociados = $ud_estratigrafica->componentesArtificialesAsociados();
        $no_asociados = $ud_estratigrafica->componentesArtificialesNoAsociados();

        $pendientes = $ud_estratigrafica->camposPendientes()->keyBy('NombreCampo')->only(['CompArtificiales'])->all();
        $pendiente = collect($pendientes);


        return view('catalogo.uds_estratigraficas.layout_cartificiales', ['ud_estratigrafica' => $ud_estratigrafica,
            'asociados' => $asociados, 'no_asociados' => $no_asociados,'pendiente' => $pendiente]);

    }

    public function asociarUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_componente = $request->input('add');

        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',
            'add'  => 'required|exists:componentesartificiales,idcartificial',

        ]);


        if ($validator->fails()) {
            return redirect('/ud_estratigrafica/' . $id_ue .'/artificiales')->withErrors($validator);
        }


        DB::table('cartificialesue')->insert(['IdCArtificial' => $id_componente, 'UE' => $id_ue]);

        return redirect('/ud_estratigrafica/' . $id_ue .'/artificiales')
            ->with('success','Componente artificial asociado correctamente');
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_componente = $request->input('delete');

        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',
            'delete'  => 'required|exists:componentesartificiales,idcartificial',

        ]);


        if ($validator->fails()) {
            return redirect('/ud_estratigrafica/' . $id_ue .'/artificiales')->withErrors($validator);
        }


        DB::table('cartificialesue')
            ->where('IdCArtificial', '=', $id_componente)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica/' . $id_ue.'/artificiales')->with('success',Lang::get('messages.asociacion_eliminada'));
    }

    public function get(){
       $artificiales = DB::table('componentesartificiales')->orderBy('denominacion')->get();

       return view('gestion.listas.layout_comp_artificales',['artificiales' => $artificiales]);

    }

    public function gestionar(Request $request){

        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:componentesartificiales,denominacion',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_artificiales')->withErrors($validator);
            }
            DB::table('componentesartificiales')->insert(['denominacion' => $keyword]);

            return redirect('/gestion_artificiales');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:componentesartificiales,idcartificial',
                'reemplazar' => 'required|unique:componentesartificiales,denominacion'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_artificiales')->withErrors($validator);
            }

            DB::table('componentesartificiales')
                ->where('idcartificial','=',$keyword)
                ->update(['denominacion' => $keyword_update]);


            return redirect('/gestion_artificiales');
        }


        if($request->submit == 'Borrar'){

            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:componentesartificiales,idcartificial',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_artificiales')->withErrors($validator);
            }

            DB::table('componentesartificiales')
                ->where('idcartificial','=',$keyword)
                ->delete();


            return redirect('/gestion_artificiales');
        }
    }
}


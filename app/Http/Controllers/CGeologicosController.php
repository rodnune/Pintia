<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CGeologicosController extends \App\Http\Controllers\Controller

{

    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociados =  DB::select(DB::raw('SELECT a.IdCGeologico, a.Denominacion 
								FROM
									ComponentesGeologicos a
								WHERE a.IdCGeologico  NOT IN
								(
                                    SELECT b.IdCgeologico 
                                    FROM CGeologicosUE b
                                    WHERE b.UE = '.$id.' 
                                  )
								'));




        $asociados =  DB::select(DB::raw('SELECT a.IdCGeologico, a.Denominacion 
								FROM
									ComponentesGeologicos a, CGeologicosUE b
								WHERE
									a.IdCGeologico = b.IdCGeologico AND
									b.UE = '. $id.'
								ORDER BY Denominacion ASC'));


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

}
<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class COrganicosController extends \App\Http\Controllers\Controller

{

    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociados =  DB::select(DB::raw('SELECT a.IdCOrganico, a.Denominacion 
								FROM
									ComponentesOrganicos a
								WHERE a.IdCOrganico  NOT IN
								(
                                    SELECT b.IdCOrganico
                                    FROM COrganicosUE b
                                    WHERE b.UE = '.$id.' 
                                  )
								'));




        $asociados =  DB::select(DB::raw('SELECT a.IdCOrganico, a.Denominacion 
								FROM
									ComponentesOrganicos a, COrganicosUE b
								WHERE
									a.IdCOrganico = b.IdCOrganico AND
									b.UE = '. $id.'
								ORDER BY Denominacion ASC'));


        return view('catalogo.uds_estratigraficas.layout_corganicos',['ud_estratigrafica' => $ud_estratigrafica, 'asociados' => $asociados,'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('add');

        DB::table('corganicosue')->insert(['IdCOrganico' => $id_componente,'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_corganicos/'.$id_ue);
    }

    public function eliminarAsociacionUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('delete');




        DB::table('corganicosue')->where(
            'IdCOrganico','=',$id_componente)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica_corganicos/'.$id_ue);
    }

}
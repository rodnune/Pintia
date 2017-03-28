<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CArtificialesController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociados = DB::select(DB::raw('SELECT a.IdCArtificial, a.Denominacion 
								FROM
									ComponentesArtificiales a
								WHERE a.IdCArtificial  NOT IN
								(
                                    SELECT b.IdCArtificial 
                                    FROM CArtificialesUE b
                                    WHERE b.UE = ' . $id . ' 
                                  )
								'));


        $asociados = DB::select(DB::raw('SELECT a.IdCArtificial, a.Denominacion 
								FROM
									ComponentesArtificiales a, CArtificialesUE b
								WHERE
									a.IdCArtificial = b.IdCArtificial AND
									b.UE = ' . $id . '
								ORDER BY Denominacion ASC'));


        return view('catalogo.uds_estratigraficas.layout_cartificiales', ['ud_estratigrafica' => $ud_estratigrafica, 'asociados' => $asociados, 'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_componente = $request->input('add');
        DB::table('cartificialesue')->insert(['IdCArtificial' => $id_componente, 'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_cartificiales/' . $id_ue);
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_componente = $request->input('delete');

        /*
         * Doble condicion where
         */
        DB::table('cartificialesue')->where(
            'IdCArtificial', '=', $id_componente)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica_cartificiales/' . $id_ue);
    }
}


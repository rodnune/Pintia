<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SuperficiesController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociados = DB::select(DB::raw('SELECT a.IdSuperficie, a.Denominacion 
								FROM
									Superficies a
								WHERE a.IdSuperficie  NOT IN
								(
                                    SELECT b.IdSuperficie 
                                    FROM SuperficiesUE b
                                    WHERE b.UE = ' . $id . ' 
                                  )
								'));


        $asociados = DB::select(DB::raw('SELECT a.IdSuperficie, a.Denominacion 
								FROM
									Superficies a, SuperficiesUE b
								WHERE
									a.IdSuperficie = b.IdSuperficie AND
									b.UE = ' . $id . '
								ORDER BY Denominacion ASC'));


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
}

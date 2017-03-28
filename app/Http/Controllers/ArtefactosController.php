<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArtefactosController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociados = DB::select(DB::raw('SELECT a.IdFosil, a.Denominacion 
								FROM
									Fosiles a
								WHERE a.IdFosil  NOT IN
								(
                                    SELECT b.IdFosil
                                    FROM FosilesUE b
                                    WHERE b.UE = ' . $id . ' 
                                  )
								'));


        $asociados = DB::select(DB::raw('SELECT a.IdFosil, a.Denominacion 
								FROM
									Fosiles a, FosilesUE b
								WHERE
									a.IdFosil = b.IdFosil AND
									b.UE = ' . $id . '
								ORDER BY Denominacion ASC'));


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
}
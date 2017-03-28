<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RelacionesEstratigraficasController extends \App\Http\Controllers\Controller

{

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociados = DB::select(DB::raw('SELECT a.UE
								FROM 
								UnidadEstratigrafica a
								WHERE a.UE  NOT IN
								(
                                    SELECT b.RelacionadaConUE
                                    FROM RelacionesEstratigraficas b
                                    WHERE b.UE = ' . $id . ' 
                                  )
								'));


        $asociados = DB::select(DB::raw('SELECT a.UE,a.TipoRelacion,a.RelacionadaConUE 
								FROM
									RelacionesEstratigraficas a, UnidadEstratigrafica b
								WHERE
									a.UE = b.UE AND
									b.UE = ' . $id . ' '));


        return view('catalogo.uds_estratigraficas.layout_relaciones',['ud_estratigrafica' => $ud_estratigrafica,'asociados' => $asociados,'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request)
    {

    }

    public function eliminarAsociacionUE(Request $request)
    {

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 30/03/2017
 * Time: 23:53
 */

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MuestrasController extends \App\Http\Controllers\Controller
{
    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociadas = DB::select(DB::raw('SELECT a.NumeroRegistro, a.Notas 
								FROM
									Muestras a
								WHERE a.NumeroRegistro  NOT IN
								(
                                    SELECT b.NumeroRegistro 
                                    FROM MuestrasUE b
                                    WHERE b.UE = ' . $id . ' 
                                  )
								'));

        $asociadas =  DB::select(DB::raw('SELECT a.NumeroRegistro, a.Notas 
								FROM
									Muestras a, MuestrasUE b
								WHERE
									a.NumeroRegistro = b.NumeroRegistro AND
									b.UE = '. $id.'
								'));

        return view('catalogo.uds_estratigraficas.layout_muestras', ['ud_estratigrafica' => $ud_estratigrafica, 'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);
    }

}
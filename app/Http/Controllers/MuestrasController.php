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

    public function index(Request $request){
                if(!$request->has('tipo')){
                    $tipos = DB::table('tiposmuestra')->orderBy('denominacion','asc')->get();
                    $muestras = DB::table('muestraesdetipo')
                        ->join('muestras','muestras.NumeroRegistro','=','muestraesdetipo.NumeroRegistro')
                        ->join('tiposmuestra','tiposmuestra.IdTipoMuestra','=','muestraesdetipo.IdTipoMuestra')
                        ->select('tiposmuestra.denominacion','muestras.*')->get();


                    $grouped = $muestras->groupBy('NumeroRegistro');

                    $array = $grouped->toArray();




                    return view('catalogo.muestras.layout_muestras',['tipos'=>$tipos,'muestras' => $array]);
                } else {
                    $tipo = $request->input('tipo');

                    $tipos = DB::table('tiposmuestra')->orderBy('denominacion','asc')->get();
                    $muestras = DB::table('muestraesdetipo')
                        ->join('muestras','muestras.NumeroRegistro','=','muestraesdetipo.NumeroRegistro')
                        ->join('tiposmuestra','tiposmuestra.IdTipoMuestra','=','muestraesdetipo.IdTipoMuestra')
                        ->where('tiposmuestra.IdTipoMuestra',$tipo)
                        ->select('tiposmuestra.denominacion','muestras.*')->get();


                    $grouped = $muestras->groupBy('NumeroRegistro');

                    $array = $grouped->toArray();



                    return view('catalogo.muestras.layout_muestras',['tipos'=>$tipos,'muestras' => $array]);
                }

    }

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

    public function asociarUE(Request $request){
        $id_ue = $request ->input('id');
        $id_muestra = $request ->input('add');
        DB::table('muestrasue')->insert(['NumeroRegistro' => $id_muestra,'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_muestras/'.$id_ue);
    }

    public function eliminarAsociacionUE(Request $request){
        $id_ue = $request ->input('id');
        $id_componente = $request ->input('delete');

        /*
         * Doble condicion where
         */
        DB::table('muestrasue')->where(
            'NumeroRegistro','=',$id_componente)
            ->where('UE', '=', $id_ue)


            ->delete();

        return redirect('/ud_estratigrafica_muestras/'.$id_ue);
    }

}
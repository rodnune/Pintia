<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 30/03/2017
 * Time: 19:37
 */

namespace app\Http\Controllers;
use App\Models\ComponenteOrganicoUE;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;


class MatrixHarrisController extends \App\Http\Controllers\Controller
{

public function indexUE($id){
    $ud_estratigrafica = UnidadEstratigrafica::find($id);

    $matrix_harris = DB::select(DB::raw('SELECT IdElementoHarris, RelacionadaConUE, PosX, PosY, PosZ
								FROM
									MatrixHarris
								WHERE
									UE = ' . $id . ' 
                                ORDER BY RelacionadaConUE  '));

    /**
     * Distinct para que solo saque una relacion en una sola direccion
     */
    $ud_asociadas = DB::select(DB::raw('SELECT DISTINCT a.RelacionadaConUE 
								FROM
									RelacionesEstratigraficas a, UnidadEstratigrafica b
								WHERE a.RelacionadaConUE  NOT IN
								(
                                    SELECT b.RelacionadaConUE
                                    FROM MatrixHarris b
                                    WHERE b.UE = ' . $id . '
                                    )
    
                                  '));




    return view('catalogo.uds_estratigraficas.layout_matrix_harris',array('ud_estratigrafica' => $ud_estratigrafica,'matrix_harris' => $matrix_harris,'ud_asociadas' => $ud_asociadas));
}

public function asociarMatrixHarris(Request $request){
    $id = $request->input('id');
    $relacionada = $request->input('relacionar');
    $x = $request->input('posx');
    $y = $request->input('posy');
    $z = $request->input('posz');

    $validator = Validator::make($request->all(), [
        'relacionar' => 'required|numeric',
        'posx'       => 'required|numeric',
        'posy' => 'required|numeric',
        'posz'       => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect('ud_estratigrafica_matrixharris/'.$id)->withErrors($validator);
    }
    DB::table('matrixharris')->insert(
        ['UE' => $id, 'RelacionadaConUE' => $relacionada,'PosX' => $x, 'PosY' => $y, 'PosZ' => $z]);

    return redirect('/ud_estratigrafica_matrixharris/'.$id);
}

public function eliminarMatrixHarris(Request $request){
    $matrix = $request -> input('id_matrix');
    $id = $request -> input('id');

    DB::table('matrixharris')->where('IdElementoHarris', '=', $matrix)->delete();

    $validator = Validator::make($request->all(), [
        'id_matrix' => 'required|numeric',

    ]);

    if ($validator->fails()) {
        return redirect('ud_estratigrafica_matrixharris/'.$id)->withErrors($validator);
    }

    return redirect('ud_estratigrafica_matrixharris/'.$id);
}

}
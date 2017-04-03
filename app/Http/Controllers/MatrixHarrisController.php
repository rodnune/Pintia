<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 30/03/2017
 * Time: 19:37
 */

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;


class MatrixHarrisController extends \App\Http\Controllers\Controller
{

    public function index(){

        $matrices = DB::table('matrixharris')->orderBy('UE')->get();

        return view('catalogo.matrix_harris.layout_matrix_harris',['matrices' => $matrices]);
    }

    public function delete(Request $request){
                $id = $request -> input('id');

                DB::table('matrixharris')->where('IdElementoHarris','=',$id)->delete();

        return redirect('/matrices_harris');

    }

    public function get(Request $request){
        $id = $request -> input('id');

        $matriz = DB::table('matrixharris')->where('IdElementoHarris','=',$id)->first();

            return view('catalogo.matrix_harris.layout_matriz',['matriz' => $matriz]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $x = $request->input('posx');
        $y = $request->input('posy');
        $z = $request->input('posz');

        $validator = Validator::make($request->all(), [
            'posx'       => 'required|numeric',
            'posy' => 'required|numeric',
            'posz'       => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/matriz_harris?id='.$id)->withErrors($validator);
        }

        DB::table('matrixHarris')
            ->where('IdElementoHarris', $id)
            ->update(['PosX' => $x, 'PosY' => $y , 'PosZ' => $z]);

        return redirect('matrices_harris');
    }

public function indexUE($id){
    $ud_estratigrafica = UnidadEstratigrafica::find($id);



            $ud_asociadas  = $ud_estratigrafica->matrixHarrisAsociar();
            $matrix_harris = $ud_estratigrafica->matrixHarris();
    


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
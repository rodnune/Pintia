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
use URL;


class MatrixHarrisController extends \App\Http\Controllers\Controller
{

    public function index(){

        $matrices = DB::table('matrixharris')->orderBy('UE')->get();

        return view('catalogo.matrix_harris.layout_matrix_harris',['matrices' => $matrices]);
    }

    public function delete(Request $request){

                $id = $request -> input('id');

        $validator = Validator::make($request->all(), [
            'id'       => 'required|exists:matrixharris,idelementoharris',
        ]);

        if ($validator->fails()) {
            return redirect('/matrices_harris')->withErrors($validator);
        }

                DB::table('matrixharris')->where('IdElementoHarris','=',$id)->delete();

        return redirect('/matrices_harris')->with('success','Matriz de Harris con id '.$id.' eliminada correctamente');

    }

    public function get($id){

        $matriz = DB::table('matrixharris')->where('IdElementoHarris','=',$id)->first();

            return view('catalogo.matrix_harris.layout_matriz',['matriz' => $matriz]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $x = $request->input('posx');
        $y = $request->input('posy');
        $z = $request->input('posz');

        $validator = Validator::make($request->all(), [
            'id'         => 'required|exists:matrixharris,idelementoharris',
            'posx'       => 'required|numeric',
            'posy'       => 'required|numeric',
            'posz'       => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('matrixHarris')
            ->where('IdElementoHarris', $id)
            ->update(['PosX' => $x, 'PosY' => $y , 'PosZ' => $z]);

        return redirect('/matriz_harris/'.$id)->with('success','Matriz Harris con id: '.$id.' modificada correctamente');
    }

public function indexUE($id){
    $ud_estratigrafica = UnidadEstratigrafica::find($id);
            $ud_asociadas  = $ud_estratigrafica->matrixHarrisAsociar();
            $matrix_harris = $ud_estratigrafica->matrixHarris();

    $pendientes = $ud_estratigrafica->camposPendientes()->keyBy('NombreCampo')->only(['MatrizHarris'])->all();
    $pendiente = collect($pendientes);
    $nota = $ud_estratigrafica->notaSeccion('Matriz Harris');
    


    return view('catalogo.uds_estratigraficas.layout_matrix_harris',array('ud_estratigrafica' => $ud_estratigrafica,
        'matrix_harris' => $matrix_harris,'ud_asociadas' => $ud_asociadas,'pendiente' => $pendiente,'nota' => $nota));
}

public function asociarMatrixHarris(Request $request){
    $id = $request->input('id');
    $relacionada = $request->input('relacionar');
    $x = $request->input('posx');
    $y = $request->input('posy');
    $z = $request->input('posz');

    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:unidadestratigrafica,ue',
        'relacionar' => 'required|exists:unidadestratigrafica,ue',
        'posx'       => 'required|numeric',
        'posy'       => 'required|numeric',
        'posz'       => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect(URL::previous())->withErrors($validator);
    }
    DB::table('matrixharris')->insert(
        ['UE' => $id, 'RelacionadaConUE' => $relacionada,'PosX' => $x, 'PosY' => $y, 'PosZ' => $z]);

    return redirect('/ud_estratigrafica/'.$id.'/matrix_harris')
        ->with('success','Matriz Harris entre UE: '.$id.' y UE: '.$relacionada.' añadida correctamente');
}

public function eliminarMatrixHarris(Request $request){
    $matrix = $request -> input('id_matrix');
    $id = $request -> input('id');


    $validator = Validator::make($request->all(), [
        'id'        => 'required|exists:unidadestratigrafica,ue',
        'id_matrix' => 'required|exists:matrixharris,idelementoharris',

    ]);

    if ($validator->fails()) {
        return redirect(URL::previous())->withErrors($validator);
    }

    DB::table('matrixharris')->where('IdElementoHarris', '=', $matrix)->delete();

    return redirect('/ud_estratigrafica/'.$id.'/matrix_harris')->with('success','Matriz de Harris con id '.$matrix.' eliminada correctamente');
}

}
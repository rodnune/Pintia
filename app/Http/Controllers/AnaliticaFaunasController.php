<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 01/02/2017
 * Time: 11:08
 */

namespace app\Http\Controllers;

use App\Models\AnaliticaFauna;
use Illuminate\Http\Request;
use Validator;

class AnaliticaFaunasController extends \App\Http\Controllers\Controller
{

    public function index(){

        $analiticasFaunas = AnaliticaFauna::all();

        return view('catalogo.analiticas_faunas.seccion_analiticas',['analiticasFaunas' => $analiticasFaunas]);
    }

    public function create(Request $request){
        $new_analitica = new AnaliticaFauna;
        $descripcion = $request ->input('descripcion');
        $partes_oseas = $request->input('partes_oseas');

        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|unique:analiticafaunas,descripcion',
            'partes_oseas' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/index/analiticas_faunas/new')
                ->withErrors($validator);
        }

        $new_analitica ->Descripcion = $descripcion;
        $new_analitica ->PartesOseasEspecieEdad = $partes_oseas;

        $new_analitica->save();

        return redirect('/index/analiticas_faunas');
    }

    public function delete(){
         $id = Input::get('id');
        $analitica_fauna = AnaliticaFauna::find($id);
        $analitica_fauna->delete();
    }



}
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

        return view('catalogo.analiticas_faunas.layout_analiticas',['analiticasFaunas' => $analiticasFaunas]);
    }

    public function get_analitica($id){

        return view('catalogo.analiticas_faunas.update_analitica',['id' => $id]);
    }

    public function create(Request $request){
        $new_analitica = new AnaliticaFauna();
        $descripcion = $request ->input('descripcion');
        $partes_oseas = $request->input('partes_oseas');


        $validator = Validator::make($request->all(), [



            'descripcion' => 'required|unique:analiticafaunas,descripcion',
            'partes_oseas' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/analiticas_faunas/new')
                ->withErrors($validator);
        }

        $new_analitica ->Descripcion = $descripcion;
        $new_analitica ->PartesOseasEspecieEdad = $partes_oseas;

        $new_analitica->save();

        return redirect('/analiticas_faunas');
    }

    public function update(Request $request){
        $id = $request ->input('id');
        $new_descripcion = $request ->input('descripcion');
        $new_partes_oseas = $request->input('partes_oseas');




        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|unique:analiticafaunas,descripcion',
            'partes_oseas' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/analiticas_faunas/'.$id)
                ->withErrors($validator);
        }
        $analitica_fauna = AnaliticaFauna::find($id);
        $analitica_fauna->Descripcion = $new_descripcion;
        $analitica_fauna ->PartesOseasEspecieEdad = $new_partes_oseas;

        $analitica_fauna->save();

        return redirect('/analiticas_faunas');

    }

    public function delete(Request $request){
         $id = $request ->input('id');
        $analitica_fauna = AnaliticaFauna::find($id);
        $analitica_fauna->delete();

        return redirect('/analiticas_faunas');
    }



}
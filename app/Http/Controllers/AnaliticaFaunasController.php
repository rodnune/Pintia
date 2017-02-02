<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 01/02/2017
 * Time: 11:08
 */

namespace app\Http\Controllers;

use App\Models\AnaliticaFauna;
use Illuminate\Support\Facades\Input;

class AnaliticaFaunasController extends \App\Http\Controllers\Controller
{

    public function index(){

        $analiticasFaunas = AnaliticaFauna::all();

        return view('catalogo.analiticas_faunas.seccion_analiticas',['analiticasFaunas' => $analiticasFaunas]);
    }

    public function create(){
        $new_analitica = new AnaliticaFauna;
        $descripcion = Input::get('descripcion');
        $partes_oseas = Input::get('partes_oseas');

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


    public function comprobarDescripcion(){

    }
}
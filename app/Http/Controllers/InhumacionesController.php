<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 14/04/2017
 * Time: 1:14
 */

namespace app\Http\Controllers;

use App\Models\UnidadEstratigrafica;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class InhumacionesController extends \App\Http\Controllers\Controller
{

    public function index(){

        return view('catalogo.inhumaciones.layout_inhumaciones');
    }

    public function create(Request $request){
               $ue_cadaver =  $request -> input('ue_cadaver');
               $ue_fosa =  $request -> input('ue_fosa');
               $ue_estructura =  $request -> input('ue_estructura');
               $ue_relleno = $request -> input('ue_relleno');
               $orientacion = $request -> input('orientacion');
                $fecha = strtotime($request -> input('fecha'));

        $validator = Validator::make($request->all(), [
            'fecha' => 'before_or_equal:actual',

        ]);

        if ($validator->fails()) {
            return redirect('/new_inhumacion')
                ->withErrors($validator);
        }











                //return $actual;

                //return $request -> all();



    }

    public function form_create(){
        $ud_estratigraficas =  UnidadEstratigrafica::all();

        return view('catalogo.inhumaciones.layout_new_inhumacion',['ud_estratigraficas' => $ud_estratigraficas]);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 02/03/2017
 * Time: 11:24
 */

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;
use Carbon\Carbon;

class ObjetosController extends \App\Http\Controllers\Controller
{

    public function index(){

        return view('catalogo.objetos.layout_objetos');

    }


    public function create(Request $request)
    {

        $referencia = $request->input('referencia');

        $validator = Validator::make($request->all(), [
            'referencia' => 'required|integer|min:0|unique:fichaobjeto,ref',
        ]);

        if ($validator->fails()) {
            return redirect('/new_objeto')->withErrors($validator);
        }

        DB::table('fichaobjeto')->insert(['ref' => $referencia, 'user_id' => Session::get('user_id')]);


        if ((Session::get('admin_level') > 0)) {
            //REGISTRAR ENTRADA


            $fecha = Carbon::now()->toDateString();

            DB::table('registro')->insert(['user_id' => Session::get('user_id') , 'fecha' => $fecha
                , 'ref' => $referencia , 'admin_level' => Session::get('admin_level')]);





        }

        return redirect('/objetos')->with('success', 'Objeto creado con exito');
    }


    public function get_objeto($id){

       $objeto = DB::table('fichaobjeto')->where('ref','=',$id)->get()->first();



        return view('catalogo.objetos.layout_objeto',['objeto' => $objeto]);
    }
}
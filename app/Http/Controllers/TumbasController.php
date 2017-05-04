<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 04/05/2017
 * Time: 17:37
 */

namespace app\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class TumbasController extends \App\Http\Controllers\Controller
{

    public function index(){

       $tumbas =  DB::table('tumba')->orderBy('IdTumba')->get();

        return view('catalogo.tumbas.layout_tumbas',['tumbas' => $tumbas]);
    }

    public function form_create(){

            return view('catalogo.tumbas.layout_new_tumba');
    }

    public function create(Request $request){

        $id = $request ->input('id_tumba');





        $validator = Validator::make($request->all(), [



            'id_tumba' => 'required|unique:tumba,IdTumba',
        ]);



        if ($validator->fails()) {
            return redirect('/new_tumba')
                ->withErrors($validator);
        }

        DB::table('tumba')->insert(['IdTumba' => $id]);

//REGISTRAR ENTRADA por Arqueólogo Novel Y Experto
        if ((Session::get('admin_level') == 1) || (Session::get('admin_level') == 2)) {

                $fecha = Carbon::now()->toDateString();
            DB::table('registro')
                ->insert(['user_id' => Session::get('user_id'), 'Fecha' => $fecha,
                    'IdTumba' => $id, 'admin_level' => Session::get('admin_level')]);


        }




        return redirect('/tumbas');
    }

}
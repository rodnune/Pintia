<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 01/06/2017
 * Time: 23:14
 */

namespace app\Http\Controllers;



use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Session;
use Carbon\Carbon;
use Config;

class MensajesController extends \App\Http\Controllers\Controller
{

    public function index(){

        $generales = DB::table('mensajesusuario')
            ->join('site_user', function ($join) {
                $join->on('mensajesusuario.user_id', '=', 'site_user.user_id')
                    ->orderBy('mensajesusuario.id_mensaje');

            })
            ->get();



        $usuarios = DB::table('site_user')->get(['username','user_id']);



        return view('mensajes.layout_mensajes',['usuarios' => $usuarios,'generales' => $generales]);
    }


    public function enviar_mensaje(Request $request){

       $privado = $request->input('privado');
       $user_destino = $request->input('destino');
        $fecha = Carbon::now();
        $contenido = $request->input('contenido');
        $categoria = $request->input('categoria');

        $validator = Validator::make($request->all(), [
            'privado' => 'required|in:' . implode(',', Config::get('enums.bool')),
            'contenido' => 'required|string'


        ]);


        if ($validator->fails()) {
            return redirect('/mensajes')
                ->withErrors($validator);
        }

       if($privado == 'Si'){

           $validator = Validator::make($request->all(), [
               'destino' => 'required|exists:site_user,user_id'


           ]);

           if ($validator->fails()) {
               return redirect('/mensajes')
                   ->withErrors($validator);
           }


           DB::table('mensajesusuario')->insert(['user_id' => Session::get('user_id'),
               'admin_level' => Session::get('admin_level'),'fecha' => $fecha,'comentario' => $contenido,'usuariodestino' => $user_destino]);

           return redirect('/mensajes');

       } else {

           $validator = Validator::make($request->all(), [
               'categoria' => 'required|integer|min:1|max:3'


           ]);

           if ($validator->fails()) {
               return redirect('/mensajes')
                   ->withErrors($validator);
           }


           DB::table('mensajesusuario')->insert(['user_id' => Session::get('user_id'),
               'admin_level' => Session::get('admin_level'),'fecha' => $fecha,'comentario' => $contenido,'categoria' => $categoria]);

                return redirect('/mensajes');
       }

       }


       public function privados(){



           $privados = DB::table('mensajesusuario')
               ->join('site_user', function ($join) {
                   $join->on('mensajesusuario.user_id', '=', 'site_user.user_id')
                       ->where('mensajesusuario.usuariodestino', '=', Session::all()['user_id']);
               })
               ->get();

           /*$privados = DB::table('mensajesusuario')
               ->where('usuariodestino','=',$id)
               ->orderBy('id_mensaje')
               ->get();*/

               return $privados;
       }

       public function expertos(){


           $expertos = DB::table('mensajesusuario')
               ->join('site_user', function ($join) {
                   $join->on('mensajesusuario.user_id', '=', 'site_user.user_id')
                       ->where('mensajesusuario.categoria', '=', 3);
               })
               ->get();

           return $expertos;
       }





    }

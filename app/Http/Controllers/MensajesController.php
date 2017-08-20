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
use App\Models\Mensaje;


class MensajesController extends \App\Http\Controllers\Controller
{

    public function index(){



        $usuarios = DB::table('site_user')->get(['username','user_id']);

        $generales = MensajesController::generales();





        return view('mensajes.layout_mensajes',['usuarios' => $usuarios,'mensajes' => $generales]);
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
               ->select('mensajesusuario.*','site_user.username')
               ->get();


               return $privados;
       }

       public function expertos(){


           $expertos = DB::table('mensajesusuario')
               ->join('site_user', function ($join) {
                   $join->on('mensajesusuario.user_id', '=', 'site_user.user_id')
                       ->where('mensajesusuario.categoria', '=', 3);
               })
               ->select('mensajesusuario.*','site_user.username')
               ->get();


           return $expertos;
       }




    public function noveles(){


        $noveles = DB::table('mensajesusuario')
            ->join('site_user', function ($join) {
                $join->on('mensajesusuario.user_id', '=', 'site_user.user_id')
                    ->where('mensajesusuario.categoria', '=', 2);

            })
            ->select('mensajesusuario.*','site_user.username')
            ->get();

        return $noveles;
    }

    public function generales(){


        $generales = DB::table('mensajesusuario')
            ->join('site_user', function ($join) {
                $join->on('mensajesusuario.user_id', '=', 'site_user.user_id')
                    ->where('mensajesusuario.categoria', '=', 1);
            })
            ->select('mensajesusuario.*','site_user.username')
            ->get();

        return $generales;
    }


    public function search(Request $request,Mensaje $mensaje){



        $validator = Validator::make($request->all(), [
            'usuario'   => 'exists:site_user,user_id',
            'categoria' =>  'integer|min:1|max:3',


        ]);




        if ($validator->fails()) {
            return redirect('/mensajes')
                ->withErrors($validator);
        }

        $mensajes =  $mensaje->newQuery();

        $mensajes = $mensajes->join('site_user','mensajesusuario.user_id','=','site_user.user_id')
            ->select('site_user.user_id' ,'mensajesusuario.Comentario','site_user.username'
                ,'mensajesusuario.Fecha','site_user.admin_level','mensajesusuario.id_mensaje');


        if($request->has('usuario')){
            $mensajes->where('mensajesusuario.user_id', $request->input('usuario'));
        }

        if($request->has('categoria')){
            $mensajes->where('categoria', $request->input('categoria'));
        }

        if($request->has('fecha')){

            if($request->input('fecha') == 'asc'){
                $mensajes->orderBy('fecha','asc');
            } else {
                $mensajes->orderBy('fecha','desc');
            }

        }

        $mensajes =  $mensajes->get();


        if($request->has('categoria')){
            if($request->input('categoria') == 1){
                $categoria = 'Generales';
            }elseif($request->input('categoria') == 2){
                $categoria = 'Noveles';
            }else{
                $categoria = 'Expertos';
            }

        }
        $usuarios = DB::table('site_user')->get(['username','user_id']);


        $user = DB::table('site_user')->where('user_id','=',$request->input('usuario'))->get(['username'])->first();



        return view('mensajes.layout_mensajes',[ 'usuarios' => $usuarios,'mensajes' => $mensajes ])
            ->with('user', $user->username)
            ->with('category',$categoria);



    }


    public function delete(Request $request){
        $id = $request->input('id_mensaje');




        $validator = Validator::make($request->all(), [
            'id_mensaje' => 'required|exists:mensajesusuario,id_mensaje'

        ]);

        if ($validator->fails()) {
            return redirect('/mensajes')
                ->withErrors($validator);
        }

        DB::table('mensajesusuario')
            ->where('id_mensaje','=',$id)
            ->delete();

        return redirect('/mensajes')->with('success','Mensaje borrado correctamente');



    }











}

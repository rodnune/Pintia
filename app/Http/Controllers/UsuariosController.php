<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 31/05/2017
 * Time: 17:13
 */

namespace app\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class UsuariosController extends \App\Http\Controllers\Controller
{

    public function index(){

       $usuarios = DB::table('site_user_info')
            ->join('users', 'users.user_id', '=', 'site_user_info.user_id')
            ->select('site_user_info.first_name','site_user_info.last_name','users.username','users.admin_level','users.user_id')
            ->orderBy('users.admin_level','desc')
            ->get();

        return view('gestion.usuarios.layout_usuarios',['usuarios' => $usuarios]);
    }


    public function form_create(){

        return view('gestion.usuarios.layout_new_usuario');
    }


    public function create(Request $request){

        $username = $request->input('username');
        $password = $request->input('password');
        $admin_level = $request->input('admin_level');
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $pais = $request->input('pais');
        $city = $request->input('city');


    }

}
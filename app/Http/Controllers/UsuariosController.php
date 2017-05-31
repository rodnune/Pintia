<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 31/05/2017
 * Time: 17:13
 */

namespace app\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class UsuariosController extends \App\Http\Controllers\Controller
{

    public function index(){

       $usuarios = DB::table('site_user_info')
            ->join('site_user', 'site_user.user_id', '=', 'site_user_info.user_id')
            ->select('site_user_info.first_name','site_user_info.last_name','site_user.username','site_user.admin_level','site_user.user_id')
            ->orderBy('site_user.admin_level','desc')
            ->get();

        return view('gestion.usuarios.layout_usuarios',['usuarios' => $usuarios]);
    }


    public function form_create(){

        return view('gestion.usuarios.layout_new_usuario');
    }

    public function search(Request $request)
    {




        if ($request->has('tipo')) {

            $usuarios = DB::table('site_user_info')
                ->join('site_user', function ($join) {
                    $join->on('site_user_info.user_id', '=', 'site_user.user_id')
                        ->where('site_user.admin_level', '=', $_REQUEST['tipo']);
                })
                ->get();



            return view('gestion.usuarios.layout_usuarios',['usuarios' => $usuarios]);
        }


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
        $hobbies = $request->input('hobbies');

        $validator = Validator::make($request->all(), [



            'username'      => 'required|unique:site_user,username',
            'password'      => 'required|string',
            'admin_level'   => 'required|numeric|between:0,3',
            'email'         => 'required|email',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'pais'          => 'required|size:2',
            'city'          => 'string|max:20',

        ]);

        if ($validator->fails()) {
            return redirect('/new_usuario')
                ->withErrors($validator);
        }


            DB::table('site_user')->insert(['username' => $username,'password' => DB::raw('PASSWORD('.$password.')'),'admin_level' => $admin_level]);

        $user_id = User::all()->last()->user_id;

        DB::table('site_user_info')->insert(['user_id' => $user_id,'first_name' => $first_name,'last_name' => $last_name,'email' => $email,
        'state' => $pais,'city' => $city, 'hobbies' => join(', ', $hobbies)]);

        return redirect('/usuarios')->with('success', 'El usuario '.$username . ' se ha creado correctamente');



    }

}
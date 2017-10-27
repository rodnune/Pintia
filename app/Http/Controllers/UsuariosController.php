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
use Session;
use URL;

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

        if(is_null($hobbies)){
            $hobbies = array();
        }


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

        $hash = $this->sqlPassword($password);



        if ($validator->fails()) {
            return redirect('/new_usuario')
                ->withErrors($validator);
        }


            User::create(['username' => $username,'password' => $hash,'admin_level' => $admin_level]);

        $user_id = User::all()->last()->user_id;

        DB::table('site_user_info')->insert(['user_id' => $user_id,'first_name' => $first_name,'last_name' => $last_name,'email' => $email,
        'state' => $pais,'city' => $city, 'hobbies' => join(', ', $hobbies)]);

        return redirect('/usuarios')->with('success', 'El usuario '.$username . ' se ha creado correctamente');



    }



    public function get_usuario($id){



        $usuario = DB::table('site_user_info')
            ->join('site_user', 'site_user.user_id', '=', 'site_user_info.user_id')
            ->where('site_user.user_id','=',$id)
            ->get()
            ->first();

            $usuario->hobbies = explode(", ",$usuario->hobbies);


        return view('gestion.usuarios.layout_update_usuario',['usuario' => $usuario]);
    }


   public function sqlPassword($input) {
    $pass = strtoupper(
            sha1(
                    sha1($input, true)
            )
    );
    $pass = '*' . $pass;
    return $pass;
}


    public function update(Request $request){

        $user_id = $request->input('id');
        $username = $request->input('username');
        $password = $request->input('password');
        $admin_level = $request->input('admin_level');
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $pais = $request->input('pais');
        $city = $request->input('city');
        $hobbies = $request->input('hobbies');

        if(is_null($hobbies)){
            $hobbies = array();
        }

        $validator = Validator::make($request->all(), [


            'id'            => 'required|exists:site_user,user_id',
            'username'      => 'required|unique:site_user,username,'.$username.',username',
            'password'      => 'required|string',
            'admin_level'   => 'required|numeric|between:0,3',
            'email'         => 'required|email',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'pais'          => 'required|size:2',
            'city'          => 'string|max:20',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);

        }

        DB::table('site_user')
            ->where('user_id','=',$user_id)
            ->update(['admin_level' => $admin_level ,'username' => $username,'password' => DB::raw('PASSWORD('.$password.')')]);

        DB::table('site_user_info')
            ->where('user_id','=',$user_id)
            ->update(['first_name' => $first_name,'last_name' => $last_name,'email' => $email,'city' => $city,
            'state' => $pais,'hobbies' =>join(', ', $hobbies) ]);


            return redirect('/usuarios')->with('success','Cuenta actualizada con exito');
    }


    public function delete_usuario($id){
        $user = User::find($id);

        return view('gestion.usuarios.layout_delete',['usuario' => $user]);
    }

    public function delete(Request $request){

        $user_id = $request->input('user_id');


        $validator = Validator::make($request->all(), [

            'user_id'      => 'required|exists:site_user,user_id',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);

        }

        DB::table('site_user_info')->where('user_id','=',$user_id)->delete();
        DB::table('site_user')->where('user_id','=',$user_id)->delete();


        return redirect('/usuarios')->with('success','Cuenta borrada con exito');


    }

    public function profile(){


        $usuario = DB::table('site_user_info')
            ->join('site_user', 'site_user.user_id', '=', 'site_user_info.user_id')
            ->where('site_user.user_id','=',Session::get('user_id'))
            ->get()
            ->first();

        return view('perfil.layout_perfil',['usuario' => $usuario]);


    }

    public function delete_profile(){

        DB::table('site_user_info')->where('user_id','=',Session::get('user_id'))->delete();
        DB::table('site_user')->where('user_id','=',Session::get('user_id'))->delete();

        Session::flush();

        return redirect('/')->with('success', 'Cuenta borrada con exito');
    }

}
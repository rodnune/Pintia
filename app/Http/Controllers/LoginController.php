<?php

namespace app\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LoginController extends \App\Http\Controllers\Controller
{


    public function is_user(Request $request)
    {

        $this->validate($request, [

            'usuario'	 =>  'required',
            'password'   =>  'required'
        ]);

            $username = $request ->input('usuario');
            $password = $request ->input('password');

            $password_sql = $this->sqlPassword($password);


        $usuario = DB::table('site_user')
            ->where('username','=',$username)
            ->where('password','=',$password_sql)
            ->get()
            ->first();




        if ($usuario!=null) {
            $nombre = DB::table('site_user_info')
                ->where('user_id','=',$usuario->user_id)
                ->get(['first_name','last_name'])
                ->first();



         Session::put('admin_level',$usuario->admin_level);
         Session::put('user_name',$usuario->username);
         Session::put('user_id',$usuario->user_id);
         Session::put('real_name',trim($nombre->first_name[0] . '. ' . $nombre->last_name));
         Session::put('logged',1);

            return view('seccion_principal');

        }else{
            return view('seccion_principal')->with('fail','El usuario no existe');


        }
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

}

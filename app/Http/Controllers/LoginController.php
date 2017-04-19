<?php

namespace app\Http\Controllers;


use App\Models\User;
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

        $usuario = User::where('username', $username)
            ->where('password', $password);

        if ($usuario->exists()) {

         Session::put('admin_level',$usuario->value('admin_level'));
         Session::put('user_id',$usuario->value('user_id'));
         Session::put('logged',1);
            return view('seccion_principal');

        }else{

            Session::put('logged',0);
            return view('seccion_principal');


        }
    }

}

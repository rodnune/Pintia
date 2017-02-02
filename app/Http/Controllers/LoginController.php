<?php

namespace app\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class LoginController extends \App\Http\Controllers\Controller
{


    public function is_user()
    {



            $username = Input::get('usuario');
        $password = Input::get('password');

        $usuario = User::where('username', $username)
            ->where('password', $password);

        if ($usuario->exists()) {

         Session::put('admin_level',$usuario->value('admin_level'));
         Session::put('logged',1);
            return view('seccion_principal');

        }else{

            return view('seccion_principal');


        }
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 01/02/2017
 * Time: 17:52
 */

namespace app\Http\Controllers;


use Illuminate\Support\Facades\Session;

class LogoutController extends \App\Http\Controllers\Controller
{
    function logout(){
        /*Si se hace logout se elimina la sesion*/
     Session::flush();
     return redirect('/');
    }

}
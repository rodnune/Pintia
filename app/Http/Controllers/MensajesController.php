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

class MensajesController extends \App\Http\Controllers\Controller
{

    public function generales(){

        return view('mensajes.layout_mensajes');
    }

}
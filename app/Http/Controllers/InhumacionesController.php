<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 14/04/2017
 * Time: 1:14
 */

namespace app\Http\Controllers;


class InhumacionesController extends \App\Http\Controllers\Controller
{

    public function index(){
        return view('catalogo.inhumaciones.layout_inhumaciones');
    }

}
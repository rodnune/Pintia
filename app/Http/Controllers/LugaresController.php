<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 31/03/2017
 * Time: 10:54
 */

namespace app\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class LugaresController extends \App\Http\Controllers\Controller
{

 public function get_lugares(){

     return view('gestion.geografia.layout_lugares');
 }


}
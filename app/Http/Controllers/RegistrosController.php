<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 05/04/2017
 * Time: 11:59
 */

namespace app\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class RegistrosController extends \App\Http\Controllers\Controller
{

    public function index(){

      $registros =   DB::table('registro')->get();

        return view('gestion.registros.layout_registros',['registros' => $registros]);
    }

}
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
use URL;

class RegistrosController extends \App\Http\Controllers\Controller
{

    public function index(){

      $registros =   DB::table('registro')
          ->leftJoin('site_user_info', 'registro.user_id', '=', 'site_user_info.user_id')
          ->select('registro.*','site_user_info.first_name','site_user_info.last_name')
          ->orderBy('registro.numcontrol','desc')
          ->get();

        return view('gestion.registros.layout_registros',['registros' => $registros]);
    }

    public function validar(Request $request){
           $control = $request->input('num_control');

        $validator = Validator::make($request->all(), [
            'num_control' => 'required|exists:registro,numcontrol',
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('registro')
            ->where('numcontrol','=',$control)
            ->delete();

        return redirect(URL::previous())->with('success','Registro con numero de control: ' .$control. ' validado correctamente');

    }

}
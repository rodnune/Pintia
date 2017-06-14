<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 02/03/2017
 * Time: 11:24
 */

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;
use Config;
use Carbon\Carbon;
use App\Models\Objeto;

class PartesObjetoController extends \App\Http\Controllers\Controller
{

    public function addParte(Request $request){
        $ref = $request->input('ref');
        $parte = $request->input('parte');

        $validator = Validator::make($request->all(), [
            'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
            'parte' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/objeto_clasificacion_partes/'. $ref)->withErrors($validator);
        }

        DB::table('parteobjeto')->insert(['ref' => $ref , 'denominacion' => $parte]);

        return redirect('/objeto_clasificacion_partes/'. $ref)->with('success','Parte objeto creada correctamente');




    }


    public function update(Request $request){

        $ref   = $request->input('ref');
        $parte = $request->input('parte');
        $cat = $request->input('cat');
        $subcat = $request->input('subcat');

        $validator = Validator::make($request->all(), [
            'ref'     => 'required|integer|min:0|exists:fichaobjeto,ref',
            'parte'  => 'required|integer|min:0|exists:parteobjeto,idparte',
        ]);

        if ($validator->fails()) {
            return redirect('/parte_objeto/'. $ref)->withErrors($validator);
        }

        if($subcat == 0){
            $subcat = null;
        }

        DB::table('parteobjeto')
            ->where('ref','=',$ref)
            ->where('idparte','=',$parte)
            ->update(['idcat' => $cat,'idsubcat' => $subcat]);

        return redirect('/parte_objeto/'. $ref)->with('success','Cambios guardados correctamente');
    }

    public function get_parte($id){


        $parte = DB::table('parteobjeto')->where('idparte','=',$id)->get()->first();
        $objeto = DB::table('fichaobjeto')->where('ref','=',$parte->Ref)->get()->first();

        $categorias = DB::table('categoria')->get();


        return view('catalogo.objetos.layout_parte_objeto',['objeto' => $objeto,'parte' => $parte,
            'categorias' => $categorias]);
    }

    public function delete(Request $request){
            $parte = $request->input('parte');
            $ref = $request->input('ref');


        $validator = Validator::make($request->all(), [
            'parte'  => 'required|integer|min:0|exists:parteobjeto,idparte',
        ]);


        if ($validator->fails()) {
            return redirect('/objeto_clasificacion_partes/'. $ref)->withErrors($validator);
        }


        DB::table('parteobjeto')
            ->where('idparte','=',$parte)
            ->delete();

        return redirect('/objeto_clasificacion_partes/'. $ref)->with('success','Parte de objeto eliminada correctamente');
    }


}
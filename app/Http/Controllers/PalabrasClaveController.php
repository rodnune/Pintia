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

class PalabrasClaveController extends \App\Http\Controllers\Controller
{

    public function indexArticulo($id){

        $articulo = Articulo::find($id);
        $asociadas = $articulo->palabrasClaveAsociadas();
        $no_asociadas = $articulo->palabrasClaveNoAsociadas();



        return view('catalogo.bibliografia.articulos.layout_palabras_clave',['articulo' => $articulo , 'asociadas' => $asociadas,'no_asociadas' => $no_asociadas]);

    }

    public function asociarArticulo(Request $request){
        $id = $request ->input('id');
        $palabra = $request ->input('add');

        DB::table('keywordsarticulo')->insert(['IdPalabraClave' => $palabra,'IdArticulo' => $id]);

        return redirect('/articulo/'.$id.'/palabras_clave');
    }

    public function eliminarAsociacionArticulo(Request $request){

            $id = $request ->input('id');
            $id_palabra = $request ->input('delete');




            DB::table('keywordsarticulo')->where(
                'IdPalabraClave','=',$id_palabra)
                ->where('IdArticulo', '=', $id)
                ->delete();

            return redirect('/articulo/'.$id.'/palabras_clave');




    }

}
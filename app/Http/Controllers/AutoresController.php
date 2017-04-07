<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 07/04/2017
 * Time: 17:23
 */

namespace app\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoresController extends \App\Http\Controllers\Controller
{
    public function indexArticulo($id){

        $articulo = Articulo::find($id);
        $asociados = $articulo->autoresAsociados();
        $no_asociados = $articulo->autoresNoAsociados();



        return view('catalogo.bibliografia.articulos.layout_autores',['articulo' => $articulo , 'asociados' => $asociados,'no_asociados' => $no_asociados]);

    }

    public function asociarArticulo(Request $request){
        $id = $request ->input('id');
        $autor = $request ->input('add');
        $orden_firma = 0;

        /**
         * Insertamos el autor con orden de firma
         */
        DB::table('autoria')->insert(['IdAutor' => $autor,'IdArticulo' => $id,'OrdenFirma' => $orden_firma]);

        return redirect('/articulo/'.$id.'/autores');
    }

    public function eliminarAsociacionArticulo(Request $request){

        $id = $request ->input('id');
        $autor = $request ->input('delete');




        DB::table('autoria')->where(
            'IdAutor','=',$autor)
            ->where('IdArticulo', '=', $id)
            ->delete();

        return redirect('/articulo/'.$id.'/autores');




    }
}
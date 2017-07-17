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
use Lang;
use URL;

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

        return redirect('/articulo/'.$id.'/palabras_clave')->with('success','Palabra clave asociada correctamente');
    }

    public function eliminarAsociacionArticulo(Request $request){

            $id = $request ->input('id');
            $id_palabra = $request ->input('delete');




            DB::table('keywordsarticulo')->where(
                'IdPalabraClave','=',$id_palabra)
                ->where('IdArticulo', '=', $id)
                ->delete();

            return redirect('/articulo/'.$id.'/palabras_clave')->with('success',Lang::get('messages.asociacion_eliminada'));




    }

    public function get(){

        $keywords = DB::table('palabraclave')->orderBy('palabraclave')->get();

        return view('gestion.listas.layout_palabras_clave',['keywords' => $keywords]);
    }

    public function gestionar(Request $request){

        if( $request->submit == 'Agregar'){

            $keyword = $request->input('nuevo');

            $validator = Validator::make($request->all(), [
                'nuevo' => 'required|unique:palabraclave,palabraclave',
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_keywords')->withErrors($validator);
            }
            DB::table('palabraclave')->insert(['palabraclave' => $keyword]);

            return redirect('/gestion_keywords')->with('success','Palabra clave: '.$keyword.' creada correctamente');

        }


        if($request->submit == 'Modificar'){
            $keyword = $request->input('palabra_clave');
            $keyword_update = $request->input('reemplazar');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:palabraclave,idpalabraclave',
                'reemplazar' => 'required|unique:palabraclave,palabraclave'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_keywords')->withErrors($validator);
            }

            DB::table('palabraclave')
                ->where('idpalabraclave','=',$keyword)
                ->update(['palabraclave' => $keyword_update]);

            $denominacion = DB::table('palabraclave')->where('idpalabraclave','=',$keyword)->first();

            return redirect('/gestion_keywords')->with('success','Palabra clave: '.$denominacion->PalabraClave.' actualizada correctamente');
        }


        if($request->submit == 'Borrar'){
            $keyword = $request->input('palabra_clave');

            $validator = Validator::make($request->all(), [
                'palabra_clave' => 'required|exists:palabraclave,idpalabraclave',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_keywords')->withErrors($validator);
            }

           $denominacion = DB::table('palabraclave')->where('idpalabraclave','=',$keyword)->first();

            DB::table('palabraclave')
                ->where('idpalabraclave','=',$keyword)
                ->delete();


            return redirect('/gestion_keywords')->with('success','Palabra clave: '.$denominacion->PalabraClave.' eliminada correctamente');
        }





    }





}
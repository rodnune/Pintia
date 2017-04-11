<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 07/04/2017
 * Time: 17:23
 */

namespace app\Http\Controllers;

use App\Models\Articulo;
use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AutoresController extends \App\Http\Controllers\Controller
{

    public function index(){
                $autores = Autor::orderBy('Nombre')->get();

                return view('catalogo.bibliografia.autores.layout_autores',['autores' => $autores ]);
    }

    public function indexArticulo($id){

        $articulo = Articulo::find($id);
        $asociados = $articulo->autoresAsociados();
        $no_asociados = $articulo->autoresNoAsociados();



        return view('catalogo.bibliografia.articulos.layout_autores',['articulo' => $articulo , 'asociados' => $asociados,'no_asociados' => $no_asociados]);

    }

    public function create(Request $request){
                    $nombre = $request -> input('nombre');
                    $apellido = $request -> input('apellido');
                    $filiacion = $request->input('filiacion');

        $validator = Validator::make($request->all(), [



            'nombre'      => 'required|alpha',
            'apellido'    => 'required|alpha',
            'filiacion'   => 'required|alpha'

        ]);

        if ($validator->fails()) {
            return redirect('/autor_new')
                ->withErrors($validator);
        }

        DB::table('autor')->insert(
            ['Nombre' => $nombre , 'Apellido' => $apellido,
                'Filiacion' => $filiacion ]
        );

        return redirect('/autores');


    }

    public function delete(Request $request){

        $id = $request->input('id');

        DB::table('autor')->where('IdAutor',$id)->delete();

        return redirect('/autores');

    }

    public function get_autor($id){
        $autor = Autor::find($id);
        $articulos = $autor->articulosAsociados();

        return view('catalogo.bibliografia.autores.layout_autor',['autor' => $autor,'articulos' => $articulos]);




    }

    public function get_form_update(Request $request){

        $id = $request -> input('autor');
        $autor = Autor::find($id);


        return view('catalogo.bibliografia.autores.layout_update_autor',['autor' => $autor]);

    }

    public function update(Request $request){
        $id = $request->input('id');
        $nombre = $request -> input('nombre');
        $apellido = $request -> input('apellido');
        $filiacion = $request->input('filiacion');

        $validator = Validator::make($request->all(), [



            'nombre'      => 'required|alpha',
            'apellido'    => 'required|alpha',
            'filiacion'   => 'required|alpha'

        ]);

        if ($validator->fails()) {
            return redirect('/editar_autor')
                ->withErrors($validator);
        }

        DB::table('autor')->where('IdAutor',$id)->update(['Nombre' =>$nombre , 'Apellido' => $apellido,
            'Filiacion' => $filiacion]);
    }

    public function asociarArticulo(Request $request){
        $id = $request ->input('id');
        $autor = $request ->input('add');
        $orden_firma = 0;

        /**
         * Insertamos el autor con orden de firma 0
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
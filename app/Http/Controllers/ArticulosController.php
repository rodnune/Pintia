<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 14/03/2017
 * Time: 12:07
 */

namespace app\Http\Controllers;


use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Articulo;
use Input;
use URL;


class ArticulosController extends \App\Http\Controllers\Controller
{

    public function index()
    {

                   $articulos = Articulo::all();

                   $palabras_clave = DB::table('palabraclave')->get();
                   $autores = DB::table('autor')->orderBy('Nombre')->get();



                   return view('catalogo.bibliografia.articulos.layout_articulos',[
                       'articulos' => $articulos,'palabras_clave' => $palabras_clave,'autores' => $autores]);

        }


        public function search(Request $request,Articulo $articulo)
        {

            $articulos = $articulo->newQuery();
            $datos = collect();


            if ($request->has('palabra_clave')) {

                $articulos->whereIn('idarticulo', function ($q) {
                    $q->select('keywordsarticulo.idarticulo')->from('keywordsarticulo')
                        ->where('keywordsarticulo.idpalabraclave', '=', Input::get('palabra_clave'));
                });
                   $keyword = DB::table('palabraclave')->where('idpalabraclave','=',Input::get('palabra_clave'))
                        ->get()->first();

                    $datos->put('keyword',$keyword->PalabraClave);

            }

            if ($request->has('autor')) {

                $articulos->whereIn('idarticulo', function ($q) {
                    $q->select('autoria.idarticulo')->from('autoria')
                        ->where('autoria.idautor', '=', Input::get('autor'));
                });
                $autor = DB::table('autor')->where('idautor','=',Input::get('autor'))
                    ->get()->first();

                $datos->put('autor',$autor);

            }

            $articulos = $articulos->get();

        return   ArticulosController::index()->with(['datos' => $datos,'articulos' => $articulos]);


        }


        public function create(Request $request){
            $titulo = $request -> input('titulo');
            $publicacion = $request -> input('publicacion');
            $numero = $request -> input('numero');
            $volumen = $request -> input('volumen');
            $paginas = $request -> input('paginas');
            $isbn = $request -> input('isbn_issn');



            $validator = Validator::make($request->all(), [



                'titulo'      => 'required|unique:articulos,Titulo',
                'publicacion' => 'required',
                'numero'      => 'required|numeric|min:0',
                'volumen'     => 'required|numeric|min:0',
                'paginas'     => 'required|numeric|min:0',
                'isbn_issn'   => 'required|min:0|max:13|unique:articulos,ISBN_ISSN'
            ]);

            if ($validator->fails()) {
                return redirect('/new_articulo')
                    ->withErrors($validator);
            }

            DB::table('articulos')->insert(
                ['Titulo' => $titulo , 'Publicacion' => $publicacion,
                 'Numero' => $numero , 'Volumen' => $volumen ,
                    'Paginas' => $paginas, 'ISBN_ISSN' => $isbn]
            );

            return redirect('/articulos')->with('success','Articulo creado con exito');

        }

        public function get_articulo($id){



            $articulo = Articulo::find($id);
            $autores = $articulo->autoresAsociados();
            $keywords =  $articulo->palabrasClaveAsociadas();
            $multimedias = $articulo->multimediaAsociado();





            return view('catalogo.bibliografia.articulos.layout_articulo',['articulo' => $articulo,'autores' => $autores,'keywords' => $keywords,'multimedias' => $multimedias ]);
        }

        public function get_form_update($id){


             $articulo = Articulo::find($id);


             return view('catalogo.bibliografia.articulos.layout_update_data',['articulo' => $articulo]);

        }

        public function update(Request $request){{

            $id = $request -> input('id');
            $titulo = $request -> input('titulo');
            $publicacion = $request -> input('publicacion');
            $numero = $request -> input('numero');
            $volumen = $request -> input('volumen');
            $paginas = $request -> input('paginas');
            $isbn = $request -> input('isbn_issn');


            $validator = Validator::make($request->all(), [


                'id'          => 'required|exists:articulos,idarticulo',
                'titulo'      => 'required|unique:articulos,Titulo,'.$titulo.',Titulo',
                'publicacion' => 'required',
                'numero'      => 'required|numeric|min:0',
                'volumen'     => 'required|numeric|min:0',
                'paginas'     => 'required|numeric|min:0',
                'isbn_issn'   => 'required|min:0|max:13|unique:articulos,ISBN_ISSN,'.$isbn.',ISBN_ISSN'
            ]);


            if ($validator->fails()) {
                return redirect(URL::previous())
                    ->withErrors($validator);
            }


            DB::table('articulos')->where('idarticulo','=',$id)->update(['Titulo' =>$titulo , 'Publicacion' => $publicacion,
            'Numero' => $numero, 'Volumen' => $volumen, 'Paginas' => $paginas, 'ISBN_ISSN' => $isbn]);
        }

        return redirect('/articulo/'.$id.'/datos')->with('success','Articulo con id: '.$id.' modificado correctamente');

        }

        public function delete(Request $request){

            $id = $request->input('id');

            DB::table('articulos')->where('IdArticulo',$id)->delete();

            return redirect('/articulos')->with('success','Articulo borrado correctamente');

        }

        public function add_nota(Request $request){
            $nota = $request->input('nota');
            $id = $request->input('id');




            $validator = Validator::make($request->all(), [


                'nota'          => 'string',
                'id'      => 'required|exists:articulos,idarticulo',
            ]);

            if ($validator->fails()) {
                return redirect(URL::previous())->withErrors($validator);
            }

            $hay_nota = DB::table('notasarticulo')
                ->where('idarticulo','=',$id)
                ->get()
                ->first();



            if(count($hay_nota) == 0){
                DB::table('notasarticulo')
                    ->insert(['idarticulo' => $id,'contenido' => $nota]);
            }else{
                DB::table('notasarticulo')
                    ->where('idarticulo','=',$id)
                    ->update(['contenido' => $nota]);

            }

            return redirect(URL::previous())->with('success','Nota añadida correctamente al articulo');





        }


}
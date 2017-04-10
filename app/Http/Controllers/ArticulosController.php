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


class ArticulosController extends \App\Http\Controllers\Controller
{

    public function index(Request $request)
    {



               if(!$request->has('palabra_clave') && !$request->has('autor')){

                   $articulos = Articulo::all();

                   $palabras_clave = DB::table('palabraclave')->get();
                   $autores = DB::table('autor')->orderBy('Nombre')->get();



                   return view('catalogo.bibliografia.articulos.layout_articulos',[
                       'articulos' => $articulos,'palabras_clave' => $palabras_clave,'autores' => $autores]);
               }


        if($request->has('palabra_clave') && $request->has('autor')) {

            $clave = $request -> input('palabra_clave');
            $autor = $request -> input('autor');
               $articulos =  Articulo::queryArticulos($autor,$clave);



                $palabras_clave = DB::table('palabraclave')->get();
                $autores = DB::table('autor')->orderBy('Nombre')->get();



                return view('catalogo.bibliografia.articulos.layout_articulos',[
                    'articulos' => $articulos,'palabras_clave' => $palabras_clave,'autores' => $autores]);




            }elseif($request->has('palabra_clave') && !$request->has('autor')){


                    $clave = $request -> input('palabra_clave');

            $articulos =  Articulo::queryClave($clave);



            $palabras_clave = DB::table('palabraclave')->get();
            $autores = DB::table('autor')->orderBy('Nombre')->get();



            return view('catalogo.bibliografia.articulos.layout_articulos',[
                'articulos' => $articulos,'palabras_clave' => $palabras_clave,'autores' => $autores]);

            }else{
            $autor = $request -> input('autor');

            $articulos =  Articulo::queryAutor($autor);


            $palabras_clave = DB::table('palabraclave')->get();
            $autores = DB::table('autor')->orderBy('Nombre')->get();



            return view('catalogo.bibliografia.articulos.layout_articulos',[
                'articulos' => $articulos,'palabras_clave' => $palabras_clave,'autores' => $autores]);

        }
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
                return redirect('/articulo_new')
                    ->withErrors($validator);
            }

            DB::table('articulos')->insert(
                ['Titulo' => $titulo , 'Publicacion' => $publicacion,
                 'Numero' => $numero , 'Volumen' => $volumen ,
                    'Paginas' => $paginas, 'ISBN_ISSN' => $isbn]
            );

            return redirect('/articulos');

        }

        public function get_articulo($id){



            $articulo = Articulo::find($id);
            $autores = $articulo->autoresAsociados();
            $keywords =  $articulo->palabrasClaveAsociadas();
            $multimedias = $articulo->multimediaAsociado();





            return view('catalogo.bibliografia.articulos.layout_articulo',['articulo' => $articulo,'autores' => $autores,'keywords' => $keywords,'multimedias' => $multimedias ]);
        }

        public function get_form_update(Request $request){

            $id = $request -> input('id');

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



                'titulo'      => 'required|unique:articulos,Titulo',
                'publicacion' => 'required',
                'numero'      => 'required|numeric|min:0',
                'volumen'     => 'required|numeric|min:0',
                'paginas'     => 'required|numeric|min:0',
                'isbn_issn'   => 'required|min:0|max:13|unique:articulos,ISBN_ISSN'
            ]);

            $articulo = Articulo::find($id);

            if ($validator->fails()) {
                return view('catalogo.bibliografia.articulos.layout_update_data',['articulo' => $articulo])
                    ->withErrors($validator);
            }


            DB::table('articulos')->where('IdArticulo',$id)->update(['Titulo' =>$titulo , 'Publicacion' => $publicacion,
            'Numero' => $numero, 'Volumen' => $volumen, 'Paginas' => $paginas, 'ISBN_ISSN' => $isbn]);
        }

        return redirect('/articulos');

        }

        public function delete(Request $request){

            $id = $request->input('id');

            DB::table('articulos')->where('IdArticulo',$id)->delete();

            return redirect('/articulos');

        }


}
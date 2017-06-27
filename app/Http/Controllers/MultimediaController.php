<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 05/04/2017
 * Time: 11:59
 */

namespace app\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\File;
use Validator;
use Config;


class MultimediaController extends \App\Http\Controllers\Controller
{

    public function index()
    {

        $multimedias = DB::table('almacenmultimedia')->get();


        return view('catalogo.multimedia.layout_multimedias', ['multimedias' => $multimedias]);
    }


    public function form_create()
    {

        return view('catalogo.multimedia.layout_new_multimedia');
    }

    public function create(Request $request)
    {


        $titulo = $request->input('titulo');
        $tipo = $request->input('tipo');
        $nombre_archivo = $_FILES['uploadfile']['name'];
        $archivo = $request->file('uploadfile');


        if ($tipo != "Documento") {

            $validator = Validator::make($request->all(), [


                'titulo' => 'required|unique:almacenmultimedia,titulo',
                'tipo' => 'required|in:' . implode(',', Config::get('enums.multimedia')),
                'uploadfile' => 'mimes:png,jpg,gif,bmp,jpeg'
            ]);

            if ($validator->fails()) {
                return redirect('/new_multimedia')
                    ->withErrors($validator);
            }

        } else {
            $validator = Validator::make($request->all(), [


                'titulo' => 'required|unique:almacenmultimedia,titulo',
                'tipo' => 'required|in:' . implode(',', Config::get('enums.multimedia')),
                'uploadfile' => 'mimes:pdf,doc,txt'
            ]);

            if ($validator->fails()) {
                return redirect('/new_multimedia')
                    ->withErrors($validator);
            }
        }


        MultimediaController::procesar_multimedia($tipo, $archivo);

        DB::table('almacenmultimedia')->insert(['titulo' => $titulo, 'tipo' => $tipo, 'nombrearchivo' => $nombre_archivo]);


        return redirect('/multimedias');


    }

    public function procesar_multimedia($tipo, $file)
    {


        $last = DB::table('almacenmultimedia')->orderBy('idmutimedia', 'desc')->get()->first();

        if ($tipo != "Documento") {
            $real = Image::make($file);
        }


        switch ($tipo) {
            case "Fotografia": {
                {





                    //Calculamos nuevas dimensiones
                    $new_width = 200;
                    $new_height = 200;

                    $thumb = Image::make($file)->resize($new_width, $new_height);

                    //No vamos a guardarlo en storage


                    $thumb->save(public_path() . '/images/fotos/thumb/thumb_' . $last->IdMutimedia . '.jpg');


                    //Storage::put('fotos/thumb', $thumb);

                }//PROCESADO IMAGENES

                $real->save(public_path() . '/images/fotos/Foto_' . $last->IdMutimedia . '.jpg');


                //Storage::put('fotos',$real);

                break;
            }
            case 'Planimetria': {


                $real->save(public_path() . '/images/planimetria/Plani_' . $last->IdMutimedia . '.jpg');

                break;
            }
            case 'Dibujo': {


                $real->save(public_path() . '/images/dibujos/Dib_' . $last->IdMutimedia . '.jpg');

                break;
            }
            case 'Documento': {


                move_uploaded_file($file, public_path() . '/images/doc/Doc_' . $last->IdMutimedia . '.' . $file->extension());
                break;
            }

        }
    }


    public function getArchivo($id)
    {

        $multimedia = DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->first();


        switch ($multimedia->Tipo) {

            case "Fotografia": {

                {

                    $file = File::get(public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg');

                    return response($file, 200)->header('Content-Type', 'image/jpg');
                    break;
                }

            }

            case "Planimetria": {

                {

                    $file = File::get(public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg');

                    return response($file, 200)->header('Content-Type', 'image/jpg');
                    break;
                }

            }

            case "Dibujo": {

                {

                    $file = File::get(public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg');

                    return response($file, 200)->header('Content-Type', 'image/jpg');
                    break;
                }

            }

            case "Documento": {


                $extension = explode(".", $multimedia->NombreArchivo);


                if ($extension[1] == 'txt') {
                    $file = File::get(public_path() . '/images/doc/Doc_' . $multimedia->IdMutimedia . '.' . $extension[1]);

                    return response($file, 200)->header('Content-Type', 'text/plain');
                }

                if ($extension[1] == 'pdf') {
                    $file = File::get(public_path() . '/images/doc/Doc_' . $multimedia->IdMutimedia . '.' . $extension[1]);

                    return response($file, 200)->header('Content-Type', 'application/pdf');
                }

                if ($extension[1] == 'doc') {
                    $file = File::get(public_path() . '/images/doc/Doc_' . $multimedia->IdMutimedia . '.' . $extension[1]);

                    return response($file, 200)->header('Content-Type', 'application/msword');
                }


                break;
            }


        }
    }


    public function form_update($id)
    {

        $multimedia = DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->first();


        return view('catalogo.multimedia.layout_update', ['multimedia' => $multimedia]);
    }

    public function update(Request $request)
    {

        $titulo = $request->input('titulo');
        $tipo = $request->input('tipo');
        $id = $request->input('id');

        $multimedia = DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->first();
        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:almacenmultimedia,idmutimedia',
            'titulo' => 'required|unique:almacenmultimedia,titulo',
            'tipo' => 'in:' . implode(',', Config::get('enums.multimedia')),

        ]);

        if ($validator->fails()) {

            return redirect('/edit_multimedia/' . $multimedia->IdMutimedia)
                ->withErrors($validator);
        }

        if ($multimedia->Tipo == 'Fotografia') {

            if ($tipo == 'Planimetria') {
                File::move(public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg');
            }

            if ($tipo == 'Dibujo') {
                File::move(public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg');
            }
        }

            if ($multimedia->Tipo == 'Planimetria') {

                if ($tipo == 'Fotografia') {
                    File::move(public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg',
                        public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg');
                }

                if ($tipo == 'Dibujo') {
                    File::move(public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg',
                        public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg');
                }
            }
                if ($multimedia->Tipo == 'Dibujo') {

                    if ($tipo == 'Fotografia') {
                        File::move(public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg',
                            public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg');
                    }

                    if ($tipo == 'Planimetria') {
                        File::move(public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg',
                            public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg');
                    }


                }


                DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->update(['titulo' => $titulo, 'tipo' => $tipo]);

                return redirect('/multimedias');

            }

            public function delete($id){

        DB::table('almacenmultimedia')
            ->where('idmutimedia','=',$id)
            ->delete();

        return redirect('/multimedias');
            }
}



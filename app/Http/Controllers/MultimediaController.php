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
use App\Models\Multimedia;
use Input;
use URL;


class MultimediaController extends \App\Http\Controllers\Controller
{

    public function index()
    {

        $multimedias = DB::table('almacenmultimedia')->get();


        return view('catalogo.multimedia.layout_multimedias', ['multimedias' => $multimedias]);
    }


    public function search(Request $request,Multimedia $multimedia)
    {


        $multimedias = $multimedia->newQuery();
        $datos = collect();

        if ($request->has('tipo')) {
            $multimedias->where('tipo',$request->input('tipo'));


            $datos->put('tipo',Input::get('tipo'));

        }

        if ($request->has('titulo')){
            $multimedias->where('titulo', 'like', '%' . Input::get('titulo') . '%');

            $datos->put('titulo',$request->input('titulo'));

        }

        $busqueda = $multimedias->get();

      return  MultimediaController::index()->with(['multimedias' => $busqueda,'datos' => $datos]);


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
                'uploadfile' => 'required|mimes:png,jpg,gif,bmp,jpeg'
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

        DB::table('almacenmultimedia')->insert(['titulo' => $titulo, 'tipo' => $tipo, 'nombrearchivo' => $nombre_archivo]);

        MultimediaController::procesar_multimedia($tipo, $archivo);




        return redirect('/multimedias')->with('success','Archivo multimedia creado correctamente');


    }

    public function procesar_multimedia($tipo, $file)
    {
            /*Redimensionar para thumb*/
        $new_width = 345;
        $new_height = 200;


        $last = DB::table('almacenmultimedia')->orderBy('idmutimedia', 'desc')->get()->first();

        if ($tipo != "Documento") {
            $real = Image::make($file);
        }


        switch ($tipo) {
            case "Fotografia": {



                    $thumb = Image::make($file)->resize($new_width, $new_height);
                    $thumb->save(public_path() . '/images/fotos/thumb/thumb_' . $last->IdMutimedia . '.jpg');
                $real->save(public_path() . '/images/fotos/Foto_' . $last->IdMutimedia . '.jpg');


                break;
            }
            case 'Planimetria': {

                $thumb = Image::make($file)->resize($new_width, $new_height);

                $real->save(public_path() . '/images/planimetria/Plani_' . $last->IdMutimedia . '.jpg');
                $thumb->save(public_path() . '/images/planimetria/thumb/thumb_' . $last->IdMutimedia . '.jpg');
                break;
            }
            case 'Dibujo': {

                $thumb = Image::make($file)->resize($new_width, $new_height);
                $thumb->save(public_path() . '/images/dibujos/thumb/thumb_' . $last->IdMutimedia . '.jpg');
                $real->save(public_path() . '/images/dibujos/Dib_' . $last->IdMutimedia . '.jpg');

                break;
            }
            case 'Documento': {


                move_uploaded_file($file, public_path() . '/images/doc/Doc_' . $last->IdMutimedia . '.' . $file->extension());
                break;
            }

        }
    }

    public function getRealPhoto($id){

        $multimedia = DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->first();

        $file = File::get(public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg');

        return response($file, 200)->header('Content-Type', 'image/jpg');

    }

    public function getRealDibujo($id){
        $multimedia = DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->first();

        $file = File::get(public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg');

        return response($file, 200)->header('Content-Type', 'image/jpg');
    }


    public function getRealPlano($id){
        $multimedia = DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->first();

        $file = File::get(public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg');

        return response($file, 200)->header('Content-Type', 'image/jpg');
        }

    public function getArchivo($id)
    {

        $multimedia = DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->first();


        switch ($multimedia->Tipo) {

            case "Fotografia": {

                {

                    $file = File::get(public_path() . '/images/fotos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');

                    return response($file, 200)->header('Content-Type', 'image/jpg');
                    break;
                }

            }

            case "Planimetria": {

                {

                    $file = File::get(public_path() . '/images/planimetria/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');

                    return response($file, 200)->header('Content-Type', 'image/jpg');
                    break;
                }

            }

            case "Dibujo": {

                {

                    $file = File::get(public_path() . '/images/dibujos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');

                    return response($file, 200)->header('Content-Type', 'image/jpg');
                    break;
                }

            }

            case "Documento": {


                $extension = explode(".", $multimedia->NombreArchivo);

                $file = File::get(public_path() . '/images/doc/Doc_' . $multimedia->IdMutimedia . '.' . $extension[1]);

                if ($extension[1] == 'txt') {

                    return response($file, 200)->header('Content-Type', 'text/plain');
                }

                if ($extension[1] == 'pdf') {

                    return response($file, 200)->header('Content-Type', 'application/pdf');
                }

                if ($extension[1] == 'doc') {

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
            'titulo' => 'required|unique:almacenmultimedia,titulo,'.$titulo.',Titulo',
            'tipo' => 'in:' . implode(',', Config::get('enums.multimedia')),

        ]);

        if ($validator->fails()) {

            return redirect(URL::previous())
                ->withErrors($validator);
        }

        if ($multimedia->Tipo == 'Fotografia') {

            if ($tipo == 'Planimetria') {
                File::move(public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg');

                 File::move(public_path() . '/images/fotos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/planimetria/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');
            }

            if ($tipo == 'Dibujo') {
                File::move(public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg');

                 File::move(public_path() . '/images/fotos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/dibujos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');
            }
        }

            if ($multimedia->Tipo == 'Planimetria') {

                if ($tipo == 'Fotografia') {
                    File::move(public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg',
                        public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg');

                    File::move(public_path() . '/images/planimetria/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/fotos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');
                }

                if ($tipo == 'Dibujo') {
                    File::move(public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg',
                        public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg');

                    File::move(public_path() . '/images/planimetria/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/dibujos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');
                }
            }

                if ($multimedia->Tipo == 'Dibujo') {

                    if ($tipo == 'Fotografia') {
                        File::move(public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg',
                            public_path() . '/images/fotos/Foto_' . $multimedia->IdMutimedia . '.jpg');

                    File::move(public_path() . '/images/dibujos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/fotos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');
                    }

                    if ($tipo == 'Planimetria') {

                        File::move(public_path() . '/images/dibujos/Dib_' . $multimedia->IdMutimedia . '.jpg',
                            public_path() . '/images/planimetria/Plani_' . $multimedia->IdMutimedia . '.jpg');

                         File::move(public_path() . '/images/dibujos/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg',
                    public_path() . '/images/planimetria/thumb/thumb_' . $multimedia->IdMutimedia . '.jpg');
                    }


                }


                DB::table('almacenmultimedia')->where('idmutimedia', '=', $id)->update(['titulo' => $titulo, 'tipo' => $tipo]);

                return redirect('/multimedias')->with('success','Multimedia modificado correctamente');

            }

            public function delete(Request $request){

        $id = $request->input('id');

                $validator = Validator::make($request->all(), [

                    'id' => 'required|exists:almacenmultimedia,idmutimedia',

                ]);

                if ($validator->fails()) {

                    return redirect(URL::previous())
                        ->withErrors($validator);
                }

                $multimedia = Multimedia::find($id);

                $id_multimedia = $multimedia->IdMutimedia;
                $tipo =  $multimedia->Tipo;




                if ($tipo == 'Fotografia') {
                    File::delete(public_path() . '/images/fotos/Foto_' . $id_multimedia.'.jpg');
                    File::delete(public_path() . '/images/fotos/thumb/thumb_' . $id_multimedia.'.jpg');
                }

                if ($tipo == 'Planimetria') {
                    File::delete(public_path() . '/images/planimetria/thumb/thumb_' . $id_multimedia.'.jpg');
                    File::delete(public_path() . '/images/planimetria/Plani_' . $id_multimedia.'.jpg');
                }

                if ($tipo == 'Documento') {
                    $nombre = explode('.',$multimedia->NombreArchivo);
                    $extension = $nombre[1];

                    File::delete(public_path() . '/images/doc/Doc_' . $id_multimedia.'.'.$extension);
                }

                if($tipo == 'Dibujo'){
                    File::delete(public_path() . '/images/dibujos/thumb/thumb_' . $id_multimedia.'.jpg');
                    File::delete(public_path() . '/images/dibujos/Dib_' . $id_multimedia.'.jpg');
                }


        DB::table('almacenmultimedia')
            ->where('idmutimedia','=',$id)
            ->delete();




        return redirect('/multimedias')->with('success','Multimedia con id: '.$id.' eliminado correctamente');


    }
}



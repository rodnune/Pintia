<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 05/04/2017
 * Time: 11:59
 */

namespace app\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Http\File;
use Validator;
use Config;
use Illuminate\Support\Facades\Storage;

class MultimediaController extends \App\Http\Controllers\Controller
{

    public function index()
    {

        return view('catalogo.multimedia.layout_multimedias');
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



            $validator = Validator::make($request->all(), [



                'titulo'     => 'required|unique:almacenmultimedia,titulo',
                'tipo'       => 'required|in:' . implode(',' ,Config::get('enums.multimedia')),
                'uploadfile' => 'mimes:png,jpg,gif,bmp,pdf,doc'
            ]);

        if ($validator->fails()) {
            return redirect('/new_multimedia')
                ->withErrors($validator);
        }




        DB::table('almacenmultimedia')->insert(['titulo' => $titulo , 'tipo' => $tipo ,'nombrearchivo' => $nombre_archivo]);



        MultimediaController::procesar_multimedia($tipo,$archivo);

        return redirect('/multimedias');
    }

    public function procesar_multimedia($tipo, $file)
    {




        $last =  DB::table('almacenmultimedia')->orderBy('idmutimedia','desc')->get()->first();


        switch ($tipo) {
            case "Fotografia": {
                {
                    $real  = Image::make($file);

                    $height = $real->height();
                    $width = $real->width();


                    //Obtenemos relación de aspecto
                    $ratio = $width / $height;

                    //Calculamos nuevas dimensiones
                    $new_width = 200;
                    $new_height = round($new_width / $ratio);

                    $thumb = Image::make($file)->resize($new_width,$new_height);

                    //No vamos a guardarlo en storage


                    $thumb->save(public_path().'/images/fotos/thumb/thumb_'.$last->IdMutimedia.'.jpg');


                    //Storage::put('fotos/thumb', $thumb);

                }//PROCESADO IMAGENES

                $real->save(public_path().'/images/fotos/Foto_'.$last->IdMutimedia.'.jpg');



                //Storage::put('fotos',$real);

                break;
            }
            case 'Planimetria': {

                $real  = Image::make($file);

                $real->save(public_path().'/images/fotos/Plani_'.$last->IdMutimedia.'.jpg');

                break;
            }
            case 'Dibujo': {
                //move_uploaded_file($_FILES['uploadfile']['tmp_name'], $dir_dib . '/Dib_' . $id_multimedia . '.' . $extension2);
                break;
            }
            case 'Documento': {

                //move_uploaded_file($_FILES['uploadfile']['tmp_name'], $dir_doc . '/Doc_' . $id_multimedia . '.' . $extension2);
                break;
            }

        }
    }





}


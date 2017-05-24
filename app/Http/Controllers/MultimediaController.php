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
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Fylesystem;

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
        $imagen = $request->file('uploadfile');


            $validator = Validator::make($request->all(), [



                'titulo'     => 'required|unique:almacenmultimedia,titulo',
                'tipo'       => 'required|in:' . implode(',' ,Config::get('enums.multimedia')),
                'uploadfile' => 'mimes:png,jpg,gif,bmp,pdf,doc'
            ]);

        if ($validator->fails()) {
            return redirect('/new_multimedia')
                ->withErrors($validator);
        }

        DB::table('almacenmultimedia')->insert([]);

        /*'INSERT INTO AlmacenMultimedia (IdMutimedia, Titulo, Descripcion, Tipo, NombreArchivo)
								VALUES (
										NULL,
										"' . mysql_real_escape_string($titulo, $db) . '",
										"' . mysql_real_escape_string($descripcion, $db) . '",
										"' . mysql_real_escape_string($tipo, $db) . '",
										"' . mysql_real_escape_string($_FILES['uploadfile']['name'], $db) . '")';*/

        MultimediaController::procesar_multimedia($id,$tipo,$imagen);


    }

    public function procesar_multimedia($tipo, $file)
    {


        $dir_plani = './images/planimetria';
        $dir_doc = './images/doc';
        $id_multimedia = 0;
        $extension2 = 0;
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

                    $id = "Hola";

                    $thumb->save(public_path().'/images/fotos/thumb/thumb_'.$id.'.jpg');


                    //Storage::put('fotos/thumb', $thumb);

                }//PROCESADO IMAGENES

                $real->save(public_path().'/images/fotos/Foto_'.$id.'.jpg');

                //Storage::put('fotos',$real);

                break;
            }
            case 'Planimetria': {
                //move_uploaded_file($_FILES['uploadfile']['tmp_name'], $dir_plani . '/Plani_' . $id_multimedia . '.' . $extension2);
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


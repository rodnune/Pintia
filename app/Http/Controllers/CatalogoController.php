<?php

namespace app\Http\Controllers;
use Illuminate\Support\Facades\File;

class CatalogoController extends \App\Http\Controllers\Controller
{

    public function retrievePic(){

        $file = File::get('images/logo-bg.png');


        return response($file, 200)->header('Content-Type', 'image/png');

    }
}
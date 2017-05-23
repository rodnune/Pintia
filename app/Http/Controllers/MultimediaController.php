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
use Validator;

class MultimediaController extends \App\Http\Controllers\Controller
{

    public function index(){

            return view('catalogo.multimedia.layout_multimedias');
    }

}
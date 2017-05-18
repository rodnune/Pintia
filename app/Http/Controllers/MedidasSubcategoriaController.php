<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 30/03/2017
 * Time: 23:53
 */

namespace app\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class MedidasSubcategoriaController extends \App\Http\Controllers\Controller
{

    public function gestionar_subcategoria(Request $request)
    {


        $subcategoria = $request->input('subcategoria');
        $categoria = $request->input('categoria');

        $validator = Validator::make($request->all(), [
            'subcategoria' => 'required|string',
            'categoria' => 'required|exists:categoria,idcat'
        ]);

        if ($validator->fails()) {
            return redirect('/categoria/' . $categoria)->withErrors($validator);
        }


        if ($request->submit == 'Agregar') {
            DB::table('subcategoria')->insert(['idcat' => $categoria,
                'denominacion' => $subcategoria]);

            return redirect('/categoria/' . $categoria);


        }
    }

        public function get_subcategoria($id){


        $subcategoria = DB::table('subcategoria')->where('idsubcat','=',$id)->first();





        return view('gestion.medidas_categoria.layout_subcategoria',['subcategoria' => $subcategoria]);
    }






}
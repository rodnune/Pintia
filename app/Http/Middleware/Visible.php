<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 16/08/2017
 * Time: 17:04
 */

namespace app\Http\Middleware;

use Closure;
use Session;
use \App\Models\Objeto;
use Lang;

class Visible
{

    public function handle($request, Closure $next){

        $id = $request->route('id');

        $objeto = Objeto::find($id);

        $visible = $objeto->VisibleCatalogo;



        if ($visible == 'Si'){

                return $next($request);
        }


        if($visible == 'No'){

            if(is_null(Session::get('admin_level')) || Session::get('admin_level')<1 ){
                    return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        }else{

            return $next($request);
        }
            }



    }

}


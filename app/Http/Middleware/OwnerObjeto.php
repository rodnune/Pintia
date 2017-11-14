<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 07/06/2017
 * Time: 0:06
 */

namespace app\Http\Middleware;

use Closure;
use Session;
use \App\Models\Objeto;
use Lang;

class OwnerObjeto
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next){

        if(!$request->isMethod('get')){
            return $next($request);
        }
        $id = $request->route('ref');

        $objeto = Objeto::find($id);

        $owner = $objeto->user_id;
        $admin_level = $objeto->admin_level();


        if(Session::get('admin_level')!=null){
                if ((Session::get('admin_level') > $admin_level) OR ($owner == Session::get('user_id'))) {
           return $next($request);
        }else{
            return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        }

        }else{
             return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        }
        

    }
}
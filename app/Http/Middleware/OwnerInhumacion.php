<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 20/08/2017
 * Time: 17:52
 */

namespace app\Http\Middleware;

use Closure;
use Session;
use \App\Models\Inhumacion;
use Lang;


class OwnerInhumacion
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
        $id = $request->route('id');

        $inhumacion = Inhumacion::find($id);

        $owner = $inhumacion->user_id;
        $admin_level = $inhumacion->admin_level();



        if ((Session::get('admin_level') > $admin_level) OR ($owner == Session::get('user_id'))) {
            return $next($request);
        }else{
            return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        }

    }

}
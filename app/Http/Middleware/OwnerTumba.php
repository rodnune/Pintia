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
use \App\Models\Tumba;
use Lang;

class OwnerTumba
{

    public function handle($request, Closure $next){

        if(!$request->isMethod('get')){
            return $next($request);
        }
        $id = $request->route('id');

        $tumba = Tumba::find($id);

        $owner = $tumba->user_id;
        $admin_level = $tumba->admin_level();



        if ((Session::get('admin_level') > $admin_level) OR ($owner == Session::get('user_id'))) {
            return $next($request);
        }else{
            return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        }
    }

}
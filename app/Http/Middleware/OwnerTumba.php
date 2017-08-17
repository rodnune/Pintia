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

        $id = $request->route('id');

        $tumba = Tumba::find($id);

        $owner = $tumba->owner()->user_id;
        $admin_level = $tumba->owner()->admin_level;
        if ((Session::get('admin_level') < 3 ||
                $owner != Session::get('user_id')) && (Session::get('admin_level') < $admin_level)) {
            return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        }



        return $next($request);
    }

}
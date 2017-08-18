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
use Lang;

class IsRegular
{

    public function handle($request, Closure $next)
    {


        if (Session::get('admin_level') < 0) {

            return response()->view('errors.layout_response', ['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        } else {

            return $next($request);
        }

    }
}
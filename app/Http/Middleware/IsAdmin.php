<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 16/08/2017
 * Time: 18:00
 */

namespace app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Lang;

class IsAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::get('admin_level')  == 3){


            return $next($request);

        }else{

            return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);

        }



    }

}
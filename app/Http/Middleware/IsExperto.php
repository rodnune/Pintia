<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 07/06/2017
 * Time: 0:06
 */

namespace app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Lang;

class IsExperto
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
       if(Session::get('admin_level') < 2){

           return response()->view('errors.layout_response',['mensaje' => Lang::get('messages.denegado'),
               'descripcion' => Lang::get('messages.no_autorizado')]);
       }


        return $next($request);
    }
}
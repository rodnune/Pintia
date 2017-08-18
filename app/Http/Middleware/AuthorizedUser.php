<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 18/08/2017
 * Time: 18:57
 */

namespace app\Http\Middleware;
use Closure;
use Session;
use \App\Models\User;
use Lang;


class AuthorizedUser
{
    public function handle($request, Closure $next)
    {

        $id = $request->route('id');

        $user = User::find($id);
        if (Session::get('admin_level') == 3 || Session::get('user_id') == $user->user_id) {

            return $next($request);

        } else {

            return response()->view('errors.layout_response', ['mensaje' => Lang::get('messages.denegado'),
                'descripcion' => Lang::get('messages.no_autorizado')]);
        }


    }
}
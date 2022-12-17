<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LangMiddleware
{
 
    public function handle(Request $request, Closure $next)
    {
        if(!empty(session('lang'))){
            \App::setlocale(session('lang'));
        }
        //Codigo para que las vistas puedan ser accedidas sin loguearse
        //print_r($request->route()->getAction()['uses']);
        if($request->route()->getName()!=''){
            $pos = strpos($request->route()->getName(), 'cefa');
            $pos2 = strpos($request->route()->getAction()['uses'], 'Auth');
            if ($pos === false && $pos2 === false) {
                Gate::authorize('haveaccess',$request->route()->getName());
            }
        }

        return $next($request);
    }
}

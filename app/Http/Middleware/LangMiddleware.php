<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LangMiddleware
{
 
    public function handle(Request $request, Closure $next)
    {
        if(!empty(session('lang'))){
            \App::setlocale(session('lang'));
        }

        return $next($request);
    }
}

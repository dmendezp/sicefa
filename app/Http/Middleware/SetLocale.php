<?php
namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = session('locale', config('app.locale')); // Usa el idioma por defecto si no está en la sesión
        app()->setLocale($locale);

        return $next($request);
    }
}
<?php

namespace Modules\CAFETO\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\SICA\Entities\Element;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\CAFETO\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        // Permite que {element} resuelva por ID o por SLUG.
        // Esto corrige el 404 cuando entras a:
        // /cafeto/admin/element/edit/prueba-del-cafe-1
        Route::bind('element', function ($value) {
            return Element::query()
                ->where('id', $value)
                ->orWhere('slug', $value)
                ->firstOrFail();
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('CAFETO', '/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('CAFETO', '/Routes/api.php'));
    }
}

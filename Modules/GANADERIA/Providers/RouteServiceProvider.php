<?php

namespace Modules\GANADERIA\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\GANADERIA\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
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
<<<<<<< HEAD
        
=======
<<<<<<< HEAD
        
=======
<<<<<<< HEAD
        
=======
        $this->mapPeopleRoutes();
        $this->mapAcademyRoutes();
        $this->mapInventoryRoutes();
        $this->mapLocationRoutes();
        $this->mapSecurityRoutes();
        $this->mapUnitRoutes();
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45
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
            ->group(module_path('GANADERIA', '/Routes/web.php'));
    }

    protected function mapPeopleRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('GANADERIA', '/Routes/people.php'));
    }

    protected function mapAcademyRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('GANADERIA', '/Routes/academy.php'));
    }

    protected function mapInventoryRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('GANADERIA', '/Routes/inventory.php'));
    }

    protected function mapLocationRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('GANADERIA', '/Routes/location.php'));
    }

    protected function mapSecurityRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('GANADERIA', '/Routes/security.php'));
    } 

    protected function mapUnitRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('GANADERIA', '/Routes/unit.php'));
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
            ->group(module_path('GANADERIA', '/Routes/api.php'));
    }
}

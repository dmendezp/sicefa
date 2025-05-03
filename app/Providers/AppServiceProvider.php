<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    // Agrega esta línea para registrar el namespace de vistas
    view()->addNamespace('senaapicola', base_path('Modules/SENAAPICOLA/Resources/views'));
}
}

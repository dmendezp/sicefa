<?php

namespace Modules\CAFETO\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Livewire\Livewire;
use Modules\CAFETO\Http\Livewire\Formulation\SelectProduct;

class CAFETOServiceProvider extends ServiceProvider
{
    /**
     * The module name in uppercase.
     *
     * @var string
     */
    protected $moduleName = 'CAFETO';

    /**
     * The module name in lowercase.
     *
     * @var string
     */
    protected $moduleNameLower = 'cafeto';

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        // Middleware alias
        $router->aliasMiddleware(
            'skip.csrf.formulations',
            \Modules\CAFETO\Http\Middleware\SkipCsrfForFormulations::class
        );

        // Livewire components (tag name: <livewire:cafeto.formulation.select-product />)
        Livewire::component('cafeto.formulation.select-product', SelectProduct::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register the module's configuration.
     */
    protected function registerConfig(): void
    {
        $configPath = module_path($this->moduleName, 'Config/config.php');

        $this->publishes([
            $configPath => config_path("{$this->moduleNameLower}.php"),
        ], 'config');

        $this->mergeConfigFrom($configPath, $this->moduleNameLower);
    }

    /**
     * Register the module's views.
     */
    protected function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], ['views', "{$this->moduleNameLower}-module-views"]);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register the module's translations.
     */
    protected function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        $this->loadTranslationsFrom(
            is_dir($langPath) ? $langPath : module_path($this->moduleName, 'Resources/lang'),
            $this->moduleNameLower
        );
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    /**
     * Get the paths for publishable views.
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];

        foreach (Config::get('view.paths', []) as $path) {
            $moduleViewPath = "{$path}/modules/{$this->moduleNameLower}";
            if (is_dir($moduleViewPath)) {
                $paths[] = $moduleViewPath;
            }
        }

        return $paths;
    }
}

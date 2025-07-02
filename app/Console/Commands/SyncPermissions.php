<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;


class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:permissions {app? : Slug del módulo (opcional)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */


    public function handle()
    {
        $filterApp = $this->argument('app');

        // Si no se especifica un módulo, confirmar antes de continuar
        if (!$filterApp) {
            $confirmed = $this->confirm('⚠️ No especificaste un módulo. ¿Deseas sincronizar permisos para TODOS los módulos y aplicaciones del sistema?', false);

            if (!$confirmed) {
                $this->info("Sincronización cancelada por el usuario.");
                return 0;
            }
        }

        $routes = Route::getRoutes();
        $this->info("🔄 Sincronizando permisos" . ($filterApp ? " del módulo [$filterApp]" : " de todos los módulos") . "...");

        foreach ($routes as $route) {
            $routeName = $route->getName();

            // Solo procesar rutas con nombre
            if (!$routeName) continue;

            // Ignorar rutas del sistema o paquetes externos
            if (
                str_starts_with($routeName, 'unisharp.') ||
                str_starts_with($routeName, 'debugbar.') ||
                str_starts_with($routeName, 'cefa.')
            ) {
                $this->warn("Ruta ignorada (sistema): $routeName");
                continue;
            }

            // Partes de la ruta: app.rol.algo
            $parts = explode('.', $routeName);
            if (count($parts) < 3) {
                $this->warn("Ruta ignorada (formato no válido): $routeName");
                continue;
            }

            [$appSlug, $roleSlug] = $parts;

            // Si se especificó una app, solo procesar rutas de esa app
            if ($filterApp && $appSlug !== $filterApp) {
                continue;
            }

            $slug = $routeName;
            $name = $routeName;

            // Buscar o crear la App
            $app = App::firstOrCreate(
                ['name' => $appSlug],
                [
                    'name' => ucfirst($appSlug),
                    'url' => '#',
                    'color' => '#000000',
                    'icon' => 'circle',
                    'description' => 'App generada automáticamente',
                    'description_english' => 'Auto-generated app',
                ]
            );

            // Crear el permiso si no existe
            $permission = Permission::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => $name,
                    'description_english' => $name,
                    'app_id' => $app->id,
                ]
            );

            // Generar slug del rol (app.rol)
            $roleSlugFull = $appSlug . '.' . $roleSlug;
            // Crear o encontrar el rol
            $role = Role::firstOrCreate(
                ['slug' => $roleSlugFull, 'app_id' => $app->id],
                [
                    'name' => ucfirst($roleSlug),
                    'description' => 'Rol generado automáticamente',
                    'description_english' => 'Auto-generated role',
                    'full_access' => 'No',
                ]
            );

            // Asignar permiso al rol si no está ya asignado
            if (!DB::table('permission_role')
                ->where('permission_id', $permission->id)
                ->where('role_id', $role->id)
                ->exists()) {
                $role->permissions()->attach($permission->id);
                $this->info("Permiso '{$slug}' asignado al rol '{$roleSlugFull}'");
            }
        }

        $this->info("Sincronización finalizada.");
    }
}

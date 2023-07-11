<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class RunModuleMigrations extends Command
{
    protected $signature = 'migrations:run-modules';

    protected $description = 'Run module migrations in a specific order';

    public function handle()
    {
        // Obtener todos los modulos disponibles del archivo module_statuses.json
        $modulesStatus = json_decode(file_get_contents(base_path('modules_statuses.json')), true);

        // Ejecutar migraciones por módulos
        foreach ($modulesStatus as $module => $status) {
            if ($status === true) {
                $this->call('migrate', [
                    '--path' => 'Modules/'.$module.'/Database/Migrations/',
                ]);
                $this->info("Migrations executed for module: {$module}");
            }
        }
    }
}

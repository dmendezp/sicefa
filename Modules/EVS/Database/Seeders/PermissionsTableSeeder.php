<?php

namespace Modules\EVS\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'EVS')->first();

        $admin = [];
        $jury  = [];
        $voter = [];

        // ------------------- RUTAS PÚBLICAS -------------------
        // 1. cefa.evs.voto.index
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.index'], [
            'name' => 'Ver página principal EVS',
            'description' => 'Acceso a /evs/index',
            'app_id' => $app->id,
        ]);
        $admin[] = $jury[] = $voter[] = $p->id;

        // 2. cefa.evs.voto.votar
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.votar'], [
            'name' => 'Formulario de votación',
            'description' => 'Acceso a /evs/votar',
            'app_id' => $app->id,
        ]);
        $voter[] = $p->id;

        // 3. cefa.evs.voto.votar.validar
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.votar.validar'], [
            'name' => 'Validar tarjetón',
            'description' => 'POST /evs/votar/validar',
            'app_id' => $app->id,
        ]);
        $voter[] = $p->id;

        // 4. cefa.evs.voto.votar.registrar
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.votar.registrar'], [
            'name' => 'Registrar voto',
            'description' => 'POST /evs/votar/registrar',
            'app_id' => $app->id,
        ]);
        $voter[] = $p->id;

        // 5. cefa.evs.voto.tarjeton
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.tarjeton'], [
            'name' => 'Ver tarjetón',
            'description' => 'Acceso a /evs/tarjeton',
            'app_id' => $app->id,
        ]);
        $voter[] = $p->id;

        // 6. cefa.evs.voto.normatividad
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.normatividad'], [
            'name' => 'Ver normatividad',
            'description' => 'Acceso a /evs/normatividad',
            'app_id' => $app->id,
        ]);
        $admin[] = $jury[] = $voter[] = $p->id;

        // 7. cefa.evs.voto.resultados
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.resultados'], [
            'name' => 'Ver resultados',
            'description' => 'Acceso a /evs/resultados',
            'app_id' => $app->id,
        ]);
        $admin[] = $jury[] = $voter[] = $p->id;

        // 8. cefa.evs.voto.desarrolladores
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.voto.desarrolladores'], [
            'name' => 'Ver desarrolladores',
            'description' => 'Acceso a /evs/desarrolladores',
            'app_id' => $app->id,
        ]);
        $admin[] = $jury[] = $voter[] = $p->id;

        // 9. evs.jurados.index
        $p = Permission::updateOrCreate(['slug' => 'evs.jurados.index'], [
            'name' => 'Panel de jurados',
            'description' => 'Acceso a /evs/jurados',
            'app_id' => $app->id,
        ]);
        $jury[] = $p->id;

        // 10. evs.admin.index
        $p = Permission::updateOrCreate(['slug' => 'evs.admin.index'], [
            'name' => 'Panel de administrador',
            'description' => 'Acceso a /evs/admin',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        // ------------------- RUTAS JURIES -------------------
        // 11. cefa.evs.juries.login
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.juries.login'], [
            'name' => 'Login de jurado',
            'description' => 'Acceso a /evs/juries/login',
            'app_id' => $app->id,
        ]);
        $jury[] = $p->id;

        // 12. cefa.evs.juries.logout
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.juries.logout'], [
            'name' => 'Logout de jurado',
            'description' => 'Acceso a /evs/juries/logout',
            'app_id' => $app->id,
        ]);
        $jury[] = $p->id;

        // 13. cefa.evs.juries.access (GET)
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.juries.access'], [
            'name' => 'Ver acceso de jurado',
            'description' => 'GET /evs/juries/access',
            'app_id' => $app->id,
        ]);
        $jury[] = $p->id;

        // 14. cefa.evs.juries.access (POST)
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.juries.access'], [
            'name' => 'Procesar acceso de jurado',
            'description' => 'POST /evs/juries/access',
            'app_id' => $app->id,
        ]);
        $jury[] = $p->id;

        // 15. cefa.evs.juries.search
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.juries.search'], [
            'name' => 'Buscar votante',
            'description' => 'POST /evs/juries/search',
            'app_id' => $app->id,
        ]);
        $jury[] = $p->id;

        // 16. cefa.evs.juries.authorized
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.juries.authorized'], [
            'name' => 'Autorizar votante',
            'description' => 'POST /evs/juries/authorized',
            'app_id' => $app->id,
        ]);
        $jury[] = $p->id;

        // 17. cefa.evs.juries.report
        $p = Permission::updateOrCreate(['slug' => 'cefa.evs.juries.report'], [
            'name' => 'Ver reporte de jurado',
            'description' => 'GET /evs/juries/report',
            'app_id' => $app->id,
        ]);
        $admin[] = $jury[] = $p->id;

        // ------------------- RUTAS ADMIN -------------------
        // 18. evs.admin.dashboard
        $p = Permission::updateOrCreate(['slug' => 'evs.admin.dashboard'], [
            'name' => 'Dashboard administrador',
            'description' => 'GET /evs/admin/dashboard',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        // Elecciones
        $p = Permission::updateOrCreate(['slug' => 'evs.admin.elections'], [
            'name' => 'Listar elecciones',
            'description' => 'Acceso a /evs/admin/elections',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.elections.add'], [
            'name' => 'Agregar elección',
            'description' => 'GET/POST /evs/admin/elections/add',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.elections.edit'], [
            'name' => 'Editar elección',
            'description' => 'GET/POST /evs/admin/election/edit/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.elections.delete'], [
            'name' => 'Eliminar elección',
            'description' => 'GET /evs/admin/election/delete/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        // Candidatos
        $p = Permission::updateOrCreate(['slug' => 'evs.admin.candidates'], [
            'name' => 'Listar candidatos',
            'description' => 'Acceso a /evs/admin/candidates',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.candidates.add'], [
            'name' => 'Agregar candidato',
            'description' => 'GET/POST /evs/admin/candidates/add',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.candidates.search'], [
            'name' => 'Buscar candidato',
            'description' => 'POST /evs/admin/candidates/search/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.candidates.edit'], [
            'name' => 'Editar candidato',
            'description' => 'GET/POST /evs/admin/candidates/edit/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.candidates.delete'], [
            'name' => 'Eliminar candidato',
            'description' => 'GET /evs/admin/candidates/delete/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        // Jurados
        $p = Permission::updateOrCreate(['slug' => 'evs.admin.juries'], [
            'name' => 'Listar jurados',
            'description' => 'Acceso a /evs/admin/juries',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.juries.add'], [
            'name' => 'Agregar jurado',
            'description' => 'GET/POST /evs/admin/juries/add',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.juries.search'], [
            'name' => 'Buscar jurado',
            'description' => 'POST /evs/admin/juries/search/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.juries.edit'], [
            'name' => 'Editar jurado',
            'description' => 'GET/POST /evs/admin/juries/edit/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.juries.delete'], [
            'name' => 'Eliminar jurado',
            'description' => 'GET /evs/admin/juries/delete/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        // Elected
        $p = Permission::updateOrCreate(['slug' => 'evs.admin.electeds'], [
            'name' => 'Listar elegidos',
            'description' => 'Acceso a /evs/admin/electeds',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.electeds.add'], [
            'name' => 'Agregar elegido',
            'description' => 'GET /evs/admin/elected/add',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.electeds.edit'], [
            'name' => 'Editar elegido',
            'description' => 'GET /evs/admin/elected/edit/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.electeds.delete'], [
            'name' => 'Eliminar elegido',
            'description' => 'GET /evs/admin/elected/delete/{id}',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        $p = Permission::updateOrCreate(['slug' => 'evs.admin.elections.add.post'], [
            'name' => 'Guardar nueva elección',
            'description' => 'POST /evs/admin/election/add/store',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;

        
        $p = Permission::updateOrCreate(['slug' => 'evs.admin.candidates.add.post'], [
            'name' => 'Guardar candidato',
            'description' => 'POST /evs/admin/election/candidates/addpost',
            'app_id' => $app->id,
        ]);
        $admin[] = $p->id;


     


        $admin[] = $p->id;
        // Asignar permisos a roles
        $roleAdmin = Role::where('slug', 'evs.admin')->first();
        $roleJury  = Role::where('slug', 'evs.jury')->first();
        $roleVoter = Role::where('slug', 'evs.voter')->first();

        $roleAdmin->permissions()->syncWithoutDetaching($admin);
        $roleJury->permissions()->syncWithoutDetaching($jury);
        $roleVoter->permissions()->syncWithoutDetaching($voter);
    }
}
<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SICA\Entities\Apprentice;

class StaffSenaempresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positionCompanyIds = PositionCompany::pluck('id')->all();
        $apprenticeIds = Apprentice::pluck('id')->all();

        // Define la cantidad de registros que deseas crear
        $numStaffMembers = 10;

        for ($i = 0; $i < $numStaffMembers; $i++) {
            $positionCompanyId = $positionCompanyIds[array_rand($positionCompanyIds)];
            $apprenticeId = $apprenticeIds[array_rand($apprenticeIds)];
            $randomImage = 'random_image_' . rand(1, 10) . '.jpg';

            // Verificar si ya existe un registro con las mismas condiciones
            StaffSenaempresa::firstOrCreate([
                'position_company_id' => $positionCompanyId,
                'apprentice_id' => $apprenticeId,
            ], [
                'image' => $randomImage,
            ]);
        }
    }
}

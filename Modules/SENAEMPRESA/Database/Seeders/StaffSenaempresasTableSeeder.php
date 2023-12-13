<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Quarter;

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
        $quarters = Quarter::orderBy('start_date')->orderBy('end_date')->get();

        // Define la cantidad de registros que deseas crear
        $numStaffMembers = 0;

        for ($i = 0; $i < $numStaffMembers; $i++) {
            // Verificar si los arreglos no están vacíos antes de usar array_rand
            if (!empty($positionCompanyIds)) {
                $positionCompanyId = $positionCompanyIds[array_rand($positionCompanyIds)];
            }

            if (!empty($apprenticeIds)) {
                $apprenticeId = $apprenticeIds[array_rand($apprenticeIds)];
            }

            $randomImage = 'random_image_' . rand(1, 10) . '.jpg';

            // Verificar si ya existe un registro con las mismas condiciones
            foreach ($quarters as $quarter) {
                StaffSenaempresa::updateOrCreate([
                    'position_company_id' => $positionCompanyId,
                    'apprentice_id' => $apprenticeId,
                    'quarter_id' => $quarter->id,
                ], [
                    'image' => $randomImage,
                ]);
            }
        }
    }
}

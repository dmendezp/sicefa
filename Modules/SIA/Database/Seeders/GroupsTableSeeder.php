<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            [
                'name' => 'SEMILLERO SEBI',
                'description' => 'El semillero de Investigación “SEBI”, desarrolla actividades investigativas que permiten a sus integrantes desenvolverse activamente dentro de las diferentes áreas del conocimiento, permitiendo la formación de jóvenes investigadores para el fortalecimiento científico y de la innovación, dentro del contexto de la conservación y el uso sostenible de la biodiversidad en la región.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SEMILLERO AGRICOLA',
                'description' => 'Desarrollar en los aprendices de titulaciones en cuyos programas de formación contemplen competencias agrícolas, capacidades para desarrollar proyectos de investigación aplicada.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SEMILLERO TEDAF',
                'description' => 'Este grupo de investigación está dirigido al desarrollo de procesos investigativos asociados con étnias de ESTEM para el desarrollo de formación en programa de educación media.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SEMILLERO IDEAR',
                'description' => 'Identificar y analizar a profundidad, mediante el análisis teórico-práctico desde las herramientas que brindan las ciencias sociales y económicas, los fenómenos asociados a las áreas agropecuarias y agroindustriales, así como contribuir en el fortalecimiento del vínculo de la academia con los productores y organizaciones empresariales.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SEMILLERO AGROGESTIÓN',
                'description' => 'Es un grupo compuesto por aprendices e instructores del Sena, que promueven la capacidad investigativa mediante el estudio teórico y la aplicación del conocimiento al desarrollo pedagógico y social, en las áreas de la educación, psicología y humanística, cuyo fin es desarrollar la habilidad de trabajo en equipo, promover el aprendizaje autónomo y facilitar la interacción entre lo académico y lo práctico, aplicado a fortalecer la formación Profesional Integral.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SEMILLERO FISENSO',
                'description' => 'Somos un grupo compuesto por aprendices e instructores del Sena, que promueven la capacidad investigativa mediante el estudio teórico y la aplicación del conocimiento al desarrollo pedagógico y social, en las áreas de la educación, psicología y humanística, cuyo fin es desarrollar la habilidad de trabajo en equipo, promover el aprendizaje autónomo y facilitar la interacción entre lo académico y lo práctico, aplicado a fortalecer la formación Profesional Integral.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('groups')->insert($groups);
    }
}
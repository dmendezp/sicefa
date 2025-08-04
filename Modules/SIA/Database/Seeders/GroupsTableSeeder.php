<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SIA\Entities\Group; 

class GroupsTableSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            [
                'name' => 'SEMILLERO SEBI',
                'description' => 'El semillero de Investigación “SEBI”, desarrolla actividades investigativas que permiten a sus integrantes desenvolverse activamente dentro de las diferentes áreas del conocimiento, permitiendo la formación de jóvenes investigadores para el fortalecimiento científico y de la innovación, dentro del contexto de la conservación y el uso sostenible de la biodiversidad en la región.',
            ],
            [
                'name' => 'SEMILLERO AGRICOLA',
                'description' => 'Desarrollar en los aprendices de titulaciones en cuyos programas de formación contemplen competencias agrícolas, capacidades para desarrollar proyectos de investigación aplicada.',
            ],
            [
                'name' => 'SEMILLERO TEDAF',
                'description' => 'Este grupo de investigación está dirigido al desarrollo de procesos investigativos asociados con étnias de ESTEM para el desarrollo de formación en programa de educación media.',
            ],
            [
                'name' => 'SEMILLERO IDEAR',
                'description' => 'Identificar y analizar a profundidad, mediante el análisis teórico-práctico desde las herramientas que brindan las ciencias sociales y económicas, los fenómenos asociados a las áreas agropecuarias y agroindustriales, así como contribuir en el fortalecimiento del vínculo de la academia con los productores y organizaciones empresariales.',
            ],
            [
                'name' => 'SEMILLERO AGROGESTIÓN',
                'description' => 'Es un grupo compuesto por aprendices e instructores del Sena, que promueven la capacidad investigativa mediante el estudio teórico y la aplicación del conocimiento al desarrollo pedagógico y social, en las áreas de la educación, psicología y humanística, cuyo fin es desarrollar la habilidad de trabajo en equipo, promover el aprendizaje autónomo y facilitar la interacción entre lo académico y lo práctico, aplicado a fortalecer la formación Profesional Integral.',
            ],
            [
                'name' => 'SEMILLERO FISENSO',
                'description' => 'Somos un grupo compuesto por aprendices e instructores del Sena, que promueven la capacidad investigativa mediante el estudio teórico y la aplicación del conocimiento al desarrollo pedagógico y social, en las áreas de la educación, psicología y humanística, cuyo fin es desarrollar la habilidad de trabajo en equipo, promover el aprendizaje autónomo y facilitar la interacción entre lo académico y lo práctico, aplicado a fortalecer la formación Profesional Integral.',
            ],
             [
                'name' => 'SEMILLERO INNOVACIÓN AGROINDUSTRIAL',
                'description' => 'Somos un grupo compuesto por aprendices e instructores del SENA, que promueven la capacidad investigativa mediante el estudio teórico y la aplicación de conocimiento a la realidad empresarial en las áreas de software Generando conocimientos y avances tecnológicos, para generar la habilidad de trabajo en equipo, promover el aprendizaje autónomo facilitar la interacción entre lo académico y lo práctico.',
            ],
             [
                'name' => 'SEMILLERO SIPPA',
                'description' => 'Es una estrategia que promueve la agrupación de estudiantes y profesores para realizar actividades de investigación que van más allá del proceso académico formal y que dinamizan la adquisición de competencias investigativas.
                                  Se caracteriza por ser un equipo de trabajo interdisciplinario, que fomenta el interés por la investigación y el desarrollo de procesos relacionados con la producción pecuaria sostenible; la inclusión de estudiantes de las diferentes titulaciones relacionadas con la red de conocimiento y la transferencia a productores de la zona, buscando un ejercicio constante de intercambio de conocimiento a partir de la articulación de la comunidad académica y el sector productivo.',
            ],
        ];

        foreach ($groups as $group) {
            Group::updateOrCreate(
                ['name' => $group['name']],
                [
                    'description' => $group['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
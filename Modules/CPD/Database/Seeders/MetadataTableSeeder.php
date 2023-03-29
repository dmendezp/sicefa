<?php

namespace Modules\CPD\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CPD\Entities\Metadata;

class MetadataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $md = Metadata::where('abbreviation','pH')->first(); // Create metada 1|1
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "pH",
                "description" => "pH",
                "unit_measure" => ""
            ]);
        }

        $md = Metadata::where('abbreviation','Ar')->first(); // Create metada 1|2
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Ar",
                "description" => "Arena",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','Arc')->first(); // Create metada 1|3
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Arc",
                "description" => "Arcilla",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','Lim')->first(); // Create metada 1|4
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Lim",
                "description" => "Limo",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','CE')->first(); // Create metada 1|5
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "CE",
                "description" => "Conductividad eléctrica",
                "unit_measure" => "dS/m"
            ]);
        }

        $md = Metadata::where('abbreviation','COT')->first(); // Create metada 1|6
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "COT",
                "description" => "Carbono orgánico",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','MO')->first(); // Create metada 1|7
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "MO",
                "description" => "Materia orgánica",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','N')->first(); // Create metada 1|8
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "N",
                "description" => "Nitrógeno",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','P')->first(); // Create metada 1|9
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "P",
                "description" => "Fosforo",
                "unit_measure" => "mg/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','Na')->first(); // Create metada 1|10
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Na",
                "description" => "Sodio",
                "unit_measure" => "meq/100g"
            ]);
        }

        $md = Metadata::where('abbreviation','K')->first(); // Create metada 1|11
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "K",
                "description" => "Potasio",
                "unit_measure" => "meq/100g"
            ]);
        }

        $md = Metadata::where('abbreviation','Ca')->first(); // Create metada 1|12
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Ca",
                "description" => "Calcio",
                "unit_measure" => "meq/100g"
            ]);
        }

        $md = Metadata::where('abbreviation','Mg')->first(); // Create metada 1|13
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Mg",
                "description" => "Magnesio",
                "unit_measure" => "meq/100g"
            ]);
        }

        $md = Metadata::where('abbreviation','Mn')->first(); // Create metada 1|14
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Mn",
                "description" => "Manganeso",
                "unit_measure" => "mg/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','Fe')->first(); // Create metada 1|15
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Fe",
                "description" => "Hierro",
                "unit_measure" => "mg/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','Zn')->first(); // Create metada 1|16
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Zn",
                "description" => "Zinc",
                "unit_measure" => "mg/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','Cu')->first(); // Create metada 1|17
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Cu",
                "description" => "Cobre",
                "unit_measure" => "mg/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','CIC')->first(); // Create metada 1|18
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "CIC",
                "description" => "Capacidad de intercambio catiónico",
                "unit_measure" => "cmol(+)/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','B')->first(); // Create metada 1|19
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "B",
                "description" => "Boro",
                "unit_measure" => "mg/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','S')->first(); // Create metada 1|20
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "S",
                "description" => "Azufre",
                "unit_measure" => "mg/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','Cd')->first(); // Create metada 1|21
        if(!$md){
            $md = Metadata::create([
                "data_id" => 1,
                "abbreviation" => "Cd",
                "description" => "Cadmio",
                "unit_measure" => "ug/kg"
            ]);
        }

        $md = Metadata::where('abbreviation','Het')->first(); // Create metada 2|1
        if(!$md){
            $md = Metadata::create([
                "data_id" => 2,
                "abbreviation" => "Het",
                "description" => "Heterótrofos",
                "unit_measure" => "Log UFC"
            ]);
        }

        $md = Metadata::where('abbreviation','Hon')->first(); // Create metada 2|2
        if(!$md){
            $md = Metadata::create([
                "data_id" => 2,
                "abbreviation" => "Hon",
                "description" => "Hogos y levaduras",
                "unit_measure" => "Log UFC"
            ]);
        }

        $md = Metadata::where('abbreviation','Bac')->first(); // Create metada 2|3
        if(!$md){
            $md = Metadata::create([
                "data_id" => 2,
                "abbreviation" => "Bac",
                "description" => "Bacterias fijadoras de nitrógeno",
                "unit_measure" => "Log UFC"
            ]);
        }

        $md = Metadata::where('abbreviation','For')->first(); // Create metada 2|4
        if(!$md){
            $md = Metadata::create([
                "data_id" => 2,
                "abbreviation" => "For",
                "description" => "Formicidae",
                "unit_measure" => "ind/m2"
            ]);
        }

        $md = Metadata::where('abbreviation','Lum')->first(); // Create metada 2|5
        if(!$md){
            $md = Metadata::create([
                "data_id" => 2,
                "abbreviation" => "Lum",
                "description" => "Lumbricidae",
                "unit_measure" => "ind/m2"
            ]);
        }

        $md = Metadata::where('abbreviation','Isop')->first(); // Create metada 2|6
        if(!$md){
            $md = Metadata::create([
                "data_id" => 2,
                "abbreviation" => "Isop",
                "description" => "Isóptera",
                "unit_measure" => "ind/m2"
            ]);
        }

        $md = Metadata::where('abbreviation','Cole')->first(); // Create metada 2|7
        if(!$md){
            $md = Metadata::create([
                "data_id" => 2,
                "abbreviation" => "Cole",
                "description" => "Coleóptera",
                "unit_measure" => "ind/m2"
            ]);
        }

        $md = Metadata::where('abbreviation','Car')->first(); // Create metada 3|1
        if(!$md){
            $md = Metadata::create([
                "data_id" => 3,
                "abbreviation" => "Car",
                "description" => "Cobertura arbórea",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','IPyE')->first(); // Create metada 3|2
        if(!$md){
            $md = Metadata::create([
                "data_id" => 3,
                "abbreviation" => "IPyE",
                "description" => "Incidencia de plagas y enfermedades",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','IE')->first(); // Create metada 3|3
        if(!$md){
            $md = Metadata::create([
                "data_id" => 3,
                "abbreviation" => "IE",
                "description" => "Incidencia de enfermedades",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','IP')->first(); // Create metada 3|4
        if(!$md){
            $md = Metadata::create([
                "data_id" => 3,
                "abbreviation" => "IP",
                "description" => "Incidencia de plagas",
                "unit_measure" => "%"
            ]);
        }

        $md = Metadata::where('abbreviation','PPC')->first(); // Create metada 3|5
        if(!$md){
            $md = Metadata::create([
                "data_id" => 3,
                "abbreviation" => "PPC",
                "description" => "Perdida de producción de cacao",
                "unit_measure" => "kg/ha"
            ]);
        }

        $md = Metadata::where('abbreviation','PC')->first(); // Create metada 3|6
        if(!$md){
            $md = Metadata::create([
                "data_id" => 3,
                "abbreviation" => "PC",
                "description" => "Producción de cacao",
                "unit_measure" => "kg/ha"
            ]);
        }

        $md = Metadata::where('abbreviation','Pre')->first(); // Create metada 4|1
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "Pre",
                "description" => "Precipitación acumulada",
                "unit_measure" => "mm"
            ]);
        }

        $md = Metadata::where('abbreviation','Tem')->first(); // Create metada 4|2
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "Tem",
                "description" => "Temperatura media",
                "unit_measure" => "°C"
            ]);
        }

        $md = Metadata::where('abbreviation','Rad')->first(); // Create metada 4|3
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "Rad",
                "description" => "Radiación acumulada",
                "unit_measure" => "MJ/m2"
            ]);
        }

        $md = Metadata::where('abbreviation','DPV')->first(); // Create metada 4|4
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "DPV",
                "description" => "Déficit de presión de vapor acumulado",
                "unit_measure" => "kPa"
            ]);
        }

        $md = Metadata::where('abbreviation','ET0')->first(); // Create metada 4|5
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "ET0",
                "description" => "Evotranspiración de referencia acumulado",
                "unit_measure" => "mm"
            ]);
        }

        $md = Metadata::where('abbreviation','ETc')->first(); // Create metada 4|6
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "ETc",
                "description" => "Evotranspiración del cultivo acumulado",
                "unit_measure" => "mm"
            ]);
        }

        $md = Metadata::where('abbreviation','EPE')->first(); // Create metada 4|7
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "EPE",
                "description" => "Eventos de transpiración extrema",
                "unit_measure" => "n dias"
            ]);
        }

        $md = Metadata::where('abbreviation','SHP')->first(); // Create metada 4|8
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "SHP",
                "description" => "Índice Shannon precipitación",
                "unit_measure" => "-"
            ]);
        }

        $md = Metadata::where('abbreviation','UC')->first(); // Create metada 4|9
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "UC",
                "description" => "Unidades de calor",
                "unit_measure" => "°C"
            ]);
        }

        $md = Metadata::where('abbreviation','CFT')->first(); // Create metada 4|10
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "CFT",
                "description" => "Cociente fototérmico",
                "unit_measure" => "MJ m-2 d-1 °C-1"
            ]);
        }

        $md = Metadata::where('abbreviation','EPL')->first(); // Create metada 4|11
        if(!$md){
            $md = Metadata::create([
                "data_id" => 4,
                "abbreviation" => "EPL",
                "description" => "Distribución y abundancia de lluvias",
                "unit_measure" => "mm"
            ]);
        }

    }
}

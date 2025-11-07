<?php

namespace Modules\CPD\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CPD\Entities\Data;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = Data::where('name','Fisicoquímico del suelo')->first();
        if(!$data){ /* Data 1 */
            $app = Data::create(["name" => "Fisicoquímico del suelo"]);
        }

        $data = Data::where('name','Biota del suelo')->first();
        if(!$data){ /* Data 2 */
            $app = Data::create(["name" => "Biota del suelo"]);
        }

        $data = Data::where('name','Cultivo de cacao')->first();
        if(!$data){ /* Data 3 */
            $app = Data::create(["name" => "Cultivo de cacao"]);
        }

        $data = Data::where('name','Clima')->first();
        if(!$data){ /* Data 4 */
            $app = Data::create(["name" => "Clima"]);
        }

    }
}

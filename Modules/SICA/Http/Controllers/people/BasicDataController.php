<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;

use Validator, Str;

class BasicDataController extends Controller
{

    public function search_basic_data($doc)
    {
        //BUSQUEDA DE PERSONAS POR NUMERO DE DOCUMENTO
    }

    public function postAddData(Request $request)
    {

    }

}

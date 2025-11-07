<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Production;

class ProductionController extends Controller
{
    public function index(){
        $title = 'Producción';
        $production = Production::with('element', 'labor')->get();
    
        $data = [
            'title' => $title,
            'production' => $production
        ];

        return view('agroindustria::instructor.productions.table', $data);
    }
}

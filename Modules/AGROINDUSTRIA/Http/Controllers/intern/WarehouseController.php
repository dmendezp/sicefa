<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DataTables;
use Illuminate\Support\Facades\DB; // Corregido el uso de 'Supoport' a 'Support'
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;

class WarehouseController extends Controller
{
    public function index()
    {
        $title = 'index';
        return view('agroindustria::storer.index', compact('title'));
    }


    public function inventory()
    {
        $title = 'Inventario';
        $elements = Element::all();//Trae todos los datos del modelo Element y los almacena en elements.
        return view('agroindustria::storer.inventory', compact('title', 'elements'));
    }
}

       
                  


                    
        
                               
                    
                            

                   
        



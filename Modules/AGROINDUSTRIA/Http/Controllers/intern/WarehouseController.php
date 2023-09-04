<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;


class WarehouseController extends Controller
{
    public function index()
    {
        $title = 'index'; 
        
        return view('agroindustria::storer.index', compact('title'));
    }

    public function epp_inventory()
    {
        $title = 'epp_inventory';
        $elements = Element::all();
        return view('agroindustria::storer.epp_inventory', compact('title'), ['elements'=>$elements]);
    }

    public function cleaning_inventory()
    {
        $title = 'cleaning_inventory';
        $elements = Element::all();
        return view('agroindustria::storer.cleaning_inventory', compact('title'), ['elements'=>$elements]);
    }

    public function input_inventory()
    {
        $title = 'input_inventory';
        $elements = Element::all();
        return view('agroindustria::storer.input_inventory', compact('title'), ['elements'=>$elements]);
    }

    public function packages_inventory()
    {
        $title = 'packages_inventory';
        $elements = Element::all();
        return view('agroindustria::storer.packages_inventory', compact('title'), ['elements'=>$elements]);
    }

    

    public function input_inventoryDelete()
    {
                 // Obtener el beneficio que deseas eliminar
                 $elements = Element::find($id);
     
                 // Verificar si el beneficio existe
                 if (!$elements) {
                     return redirect()->route('agroindustria.storer.input_inventory')->with('error', 'El beneficio no existe.');
                 }
             
                 // Eliminar el beneficio
                 $elements->delete();
             
                 // Redirigir con un mensaje de éxito
                 return redirect()->route('agroindustria.storer.input_inventory')->with('success', 'Elemento eliminado con éxito');
        
        $title = 'create';
        return view('agroindustria::storer.create', compact('title'));
    }

    



    
}

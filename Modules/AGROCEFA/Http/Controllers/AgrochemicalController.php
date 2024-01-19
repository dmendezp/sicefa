<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\AgriculturalLabor;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\AGROCEFA\Entities\Crop;
use Modules\AGROCEFA\Entities\Variety;
use Modules\AGROCEFA\Entities\Specie;
use Illuminate\Support\Facades\Session;
use Modules\SICA\Entities\Inventory;

use Carbon\Carbon; // Importa la clase Carbon para trabajar con fechas

class AgrochemicalController  extends Controller
{

    public function agrochemical()
    {
        // Obtener la unidad productiva asociada al usuario
        $selectedUnitId = Session::get('selectedUnitId'); //unidad seleccionada cuando inicia sesion

        $species = Specie::where('productive_unit_id', $selectedUnitId)->pluck('id');
        $varities = Variety::where('specie_id', $species)->pluck('id');
        $crops = Crop::where('variety_id', $varities)->get();


        // Definir otras variables necesarias
        $date = Carbon::now();
        $agriculturalLabors = AgriculturalLabor::get();
        $nombresComerciales = Element::with('measurement_unit')->get();
        $measurement_unit = MeasurementUnit::get();
        $sown_area = Crop::get();
        
        //consultar AGROQUIMICOS asociados a la unidad productiva selecionada
        $elements = Element::whereHas('inventories.productive_unit_warehouse.productive_unit', function($query) use ($selectedUnitId) {
            $query->where('id', $selectedUnitId);
        })->get();

        
        

        return view('agrocefa::labormanagement.agrochemical', [
            'date' => $date,
            'agriculturalLabors' => $agriculturalLabors,
            'nombresComerciales' => $nombresComerciales,
            'measurement_unit' => $measurement_unit,
            'sown_area' => $sown_area,
            'crops' => $crops,       
            'elements' => $elements   
        ]);
    }

    public function obtenerPrecioUnitario($id)
    {
        // Buscar el agroquímico en la tabla de inventarios
        $inventario = Inventory::where('element_id', $id)->first();

        if ($inventario) {
            $precioUnitario = $inventario->price;
        } else {
            $precioUnitario = 'N/A';
        }

        // Devolver el precio unitario en formato JSON
        return response()->json(['precio_unitario' => $precioUnitario]);
    }


}

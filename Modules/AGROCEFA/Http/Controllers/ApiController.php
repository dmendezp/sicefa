<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Spatie\Permission\Models\Role;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\MovementType;
use Modules\AGROCEFA\Entities\CropEnvironment;
use Modules\SICA\Entities\Labor;
use Carbon\Carbon;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\ProductiveUnitWarehouse;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function unit()
    {

        // Limpiar la variable 'selectedUnitName'
        Session::forget('selectedUnitName');

        // Limpiar la variable 'selectedRole'
        Session::forget('selectedRole');

        $unitIds = [];

        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtiene el usuario autenticado
            $user = Auth::user();

            // Obtén el ID del rol del usuario
            $productive_units_role = $user
                ->roles()
                ->with('productive_units')
                ->get();

            // Recorre la colección de roles
            foreach ($productive_units_role as $role) {
                // Accede a la relación "productive_units" en cada rol
                $productiveUnits = $role->productive_units;

                // Recorre las unidades productivas y agrega sus IDs al array
                foreach ($productiveUnits as $unit) {
                    $unitIds[] = $unit->id;
                }
            }

            // Variable para verificar el acceso completo
            $hasFullAccess = false;

            // Recorre la colección de roles
            foreach ($productive_units_role as $role) {
                // Verifica si el rol tiene el atributo 'full_access'
                if ($role->full_access === 'Si' ) {
                   
                    $hasFullAccess = true;
                    break; // Rompe el bucle si se encuentra un rol con acceso completo
                }

            }
            
            if($hasFullAccess === true )
            {
                $productiveUnits = ProductiveUnit::get();
            }
            else {
                $productiveUnits = ProductiveUnit::whereIn('id', $unitIds)->get();
            }

            
            return response([
                'unidades' => $productiveUnits,
            ], 200);
        }
    }
    public function lotes($id)
    {

        $lotData = EnvironmentProductiveUnit::where('productive_unit_id', $id)
            ->with('environment')
            ->get();

        
            
            return response([
                'lotes' => $lotData,
            ], 200);
    }
    public function cultivos($id)
    {

        $lots = CropEnvironment::with('crop')
                ->where('environment_id', $id)
                ->get();
                
            return response([
                'cultivos' => $lots,
            ], 200);
    }

    public function balance($id)
    {

        // Inicializa la variable para los resultados filtrados
        $filteredLabors = null;
        
        // Verifica si se ha seleccionado un cultivo
        if ($id) {
            // Realiza una consulta para obtener todas las labores relacionadas con el cultivo seleccionado
            $allLabors = Labor::whereHas('crops', function ($query) use ($id) {
                $query->where('crop_id', $id);
            })->get();
            
            // Filtra las labores por fechas
            $filteredLabors = $allLabors->filter(function ($labor) {
                $executionDate = $labor->execution_date;
                $seedTime = $labor->crops->first()->seed_time;
                $finishDate = $labor->crops->first()->finish_date;

                // Verifica si es una labor de producción
                if ($labor->activity->activity_type->name === 'Producción') {
                    $totalProductionPrice = 0;

                    // Recorre las producciones de esta labor
                    foreach ($labor->productions as $production) {
                        // Asegúrate de que la relación 'element' esté cargada
                        if (!is_null($production->element)) {
                            $totalProductionPrice += $production->amount * $production->element->price;
                        }
                    }

                    $labor->totalProductionPrice = $totalProductionPrice;
                }
               

                // Verifica si hay fecha final, si no, usa la fecha actual
                $finishDate = $finishDate ?? now(); // now() obtiene la fecha y hora actual

                return $executionDate >= $seedTime && $executionDate <= $finishDate;
            });
        }

        // Inicializa las variables para los totales de gastos y producciones
        $totalExpenses = 0;
        $totalProductions = 0;

        if (!empty($filteredLabors) && count($filteredLabors) > 0) {
            foreach ($filteredLabors as $labor) {
                // Calcula los totales de gastos y producciones
                $totalExpenses += $labor->price;
                if ($labor->activity->activity_type->name === 'Producción') {
                    $totalProductions += $labor->totalProductionPrice;
                }
            }
        }

        return response()->json([
            'filteredLabors' => $filteredLabors,
            'totalExpenses' => $totalExpenses,
            'totalProductions' => $totalProductions,
        ]);
    }


}
   


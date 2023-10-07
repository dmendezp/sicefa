<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Person;
use Modules\AGROCEFA\Entities\Tool;
use Modules\AGROCEFA\Entities\Crop;
use Modules\AGROCEFA\Entities\Variety;

use App\Models\User;

class LaborManagementController extends Controller
{


    //rutas de la vista de las tarjetas y la de labores culturales
    public function index()
    {
        return view('agrocefa::labormanagement.index');
    }

    public function culturalwork()
    {

        // Fecha actual
        $date = Carbon::now();


        // Obtén el ID de la unidad productiva seleccionada de la sesión
         $this->selectedUnitId= Session::get('selectedUnitId');
        
        // ---------------- Filtro para las Actividades de esa unidad -----------------------

        $lotData = EnvironmentProductiveUnit::where('productive_unit_id', $this->selectedUnitId)->with('environment')->get();

        // Inicializa un array para almacenar los nombres y IDs de los ambientes
        $environmentData = [];

        // Recorre la colección y obtén los nombres y IDs de los ambientes
        foreach ($lotData as $item) {
            $environmentId = $item->environment->id;
            $environmentName = $item->environment->name;
            
            // Agrega un array asociativo con el ID y el nombre del ambiente al array de datos
            $environmentData[] = [
                'id' => $environmentId,
                'name' => $environmentName,
            ];
        }


        // ---------------- Filtro para las Actividades de esa unidad -----------------------

        // Intenta encontrar la unidad productiva por su ID y verifica si se encuentra
        $activitys = Activity::where('productive_unit_id', $this->selectedUnitId)->get();


        // Inicializa un array para almacenar la información de las bodegas
        $activitysData = [];

        // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
        if ($activitys) {
            // Mapea las bodegas y agrega su información al array
            $activitysData = $activitys->map(function ($activity) {

                return [
                    'id' => $activity->id,
                    'name' => $activity->name,
                ];
            }); 
        }


    
        // ---------------- Retorno a vista y funciones -----------------------

        return view('agrocefa::labormanagement.culturalwork', [
            'date' => $date,
            'activitysData' => $activitysData,
            'environmentData' => $environmentData,

        ]);
    }
    
    public function agrochemicals()
    {
        return view('agrocefa::labormanagement.agrochemicals');
    }

    public function fertilizers()
    {
        return view('agrocefa::labormanagement.fertilizers');
    }

    public function obteneresponsability(Request $request)
    {
        try {
            // Obtén el ID de la unidad productiva seleccionada de la sesión
            $this->selectedUnitId = Session::get('selectedUnitId');

            $activityid = $request->input('activity');

            // Carga la unidad productiva con las relaciones necesarias
            $activities = Activity::with('responsibilities.role.users.person')
                ->where('productive_unit_id', $this->selectedUnitId)->where('id',$activityid)
                ->first();

            $peopleData = []; // Array para almacenar los datos de las personas

            if ($activities) {
                foreach ($activities->responsibilities as $responsibility) {
                    foreach ($responsibility->role->users as $user) {
                        $person = $user->person;
            
                        // Agregar los datos de la persona al array si existe
                        if ($person) {
                            $peopleData[] = [
                                'id' => $person->id,
                                'first_name' => $person->first_name,
                            ];
                        }
                    }
                }
            }

            // Combinar la información de los IDs y first_name de las personas en un solo arreglo
            $response = [
                'people_data' => $peopleData,
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error('Error en la solicitud AJAX: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function obtenerecrop(Request $request)
{
    try {
        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $this->selectedUnitId = Session::get('selectedUnitId');

        $lotid = $request->input('lot');

        // Carga la unidad productiva con las relaciones necesarias
        $lots = Environment::with('crops')
            ->where('id', $lotid)
            ->first();
        
        $cropData = []; // Array para almacenar los datos de las personas

        if ($lots) {
            foreach ($lots->crops as $crop) {
                // Agregar los datos de la persona al array si existe
                if ($crop) {
                    $cropData[] = [
                        'id' => $crop->id,
                        'name' => $crop->name,
                    ];
                }
            }
        }
        // Combinar la información de los IDs y first_name de las personas en un solo arreglo
        $response = [
            'crop_data' => $cropData,
        ];
  
        return response()->json($response);
    } catch (\Exception $e) {
        \Log::error('Error en la solicitud AJAX: ' . $e->getMessage());
        return response()->json(['error' => 'Error interno del servidor'], 500);
    }
}





}

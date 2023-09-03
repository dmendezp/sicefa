<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Role;
use App\Models\User;

class MovementController extends Controller
{
    private $selectedUnitId ;
    public function viewmovements()
    {
        return view('agrocefa::movements.index');
    }

    public function formentrance()
    {
        // Fecha actual
        $date = Carbon::now();

        // Obtén el ID de la unidad productiva seleccionada de la sesión
         $this->selectedUnitId= Session::get('selectedUnitId');

        // Verifica si hay un ID de unidad seleccionada en la sesión
        if ($this->selectedUnitId) {
            // Obtiene todas las actividades asociadas a la unidad productiva seleccionada
            $activities = Activity::where('productive_unit_id', $this->selectedUnitId)->pluck('id');

            // Obtiene el rol de las responsabilidades relacionadas con la actividades
            $responsibilities = Responsibility::whereIn('activity_id', $activities)->pluck('role_id');

            // Obtén los ids de usuarios relacionados con los roles de responsabilidades
            $userIds = Role::whereIn('id', $responsibilities)
                ->with('users:id')
                ->get()
                ->pluck('users')
                ->flatten()
                ->pluck('id')
                ->unique()
                ->toArray();

            $people = User::whereIn('id', $userIds)
                ->with('person:id,first_name,first_last_name')
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'first_name' => $user->person->first_name,
                        'first_last_name' => $user->person->first_last_name,
                    ];
                });

            $wer = 'Almacen';
            // Realiza una consulta para obtener las unidades productivas relacionadas con 'Almacen'
            $units = ProductiveUnit::whereHas('productive_unit_warehouses', function ($query) use ($wer) {
                $query->where('name', $wer);
            })->get();
            
            // Ahora, puedes obtener los IDs y nombres de las bodegas relacionadas con las unidades productivas
            $werhousentrance = $units->flatMap(function ($unit) {
                return $unit->productive_unit_warehouses->map(function ($relation) {
                    return [
                        'id' => $relation->warehouse_id,
                        'name' => $relation->warehouse->name,
                    ];
                });
            });

            // Realiza una consulta para obtener las unidades productivas relacionadas con 'Almacen'
            $units = ProductiveUnit::whereHas('productive_unit_warehouses', function ($query) use ($wer) {
                $query->where('id', $this->selectedUnitId);
            })->get();
            
            // Ahora, puedes obtener los IDs y nombres de las bodegas relacionadas con las unidades productivas
            $receivewarehouse = $units->flatMap(function ($unit) {
                return $unit->productive_unit_warehouses->map(function ($relation) {
                    return [
                        'id' => $relation->warehouse_id,
                        'name' => $relation->warehouse->name,
                    ];
                });
            });

        }

        return view('agrocefa::movements.formentrance', [
            'people' => $people,
            'date' => $date,
            'werhousentrance' => $werhousentrance,
            'receivewarehouse' => $receivewarehouse,
        ]);
    }

    public function formexit()
    {
               // Fecha actual
               $date = Carbon::now();

               // Obtén el ID de la unidad productiva seleccionada de la sesión
                $this->selectedUnitId= Session::get('selectedUnitId');
       
               // Verifica si hay un ID de unidad seleccionada en la sesión
               if ($this->selectedUnitId) {
                   // Obtiene todas las actividades asociadas a la unidad productiva seleccionada
                   $activities = Activity::where('productive_unit_id', $this->selectedUnitId)->pluck('id');
       
                   // Obtiene el rol de las responsabilidades relacionadas con la actividades
                   $responsibilities = Responsibility::whereIn('activity_id', $activities)->pluck('role_id');
       
                   // Obtén los ids de usuarios relacionados con los roles de responsabilidades
                   $userIds = Role::whereIn('id', $responsibilities)
                       ->with('users:id')
                       ->get()
                       ->pluck('users')
                       ->flatten()
                       ->pluck('id')
                       ->unique()
                       ->toArray();
       
                   $people = User::whereIn('id', $userIds)
                       ->with('person:id,first_name,first_last_name')
                       ->get()
                       ->map(function ($user) {
                           return [
                               'id' => $user->id,
                               'first_name' => $user->person->first_name,
                               'first_last_name' => $user->person->first_last_name,
                           ];
                       });
       
                   $wer = 'Almacen';
                   // Realiza una consulta para obtener las unidades productivas relacionadas con 'Almacen'
                   $units = ProductiveUnit::whereHas('productive_unit_warehouses', function ($query) use ($wer) {
                       $query->where('name', $wer);
                   })->get();
                   
                   // Ahora, puedes obtener los IDs y nombres de las bodegas relacionadas con las unidades productivas
                   $werhousentrance = $units->flatMap(function ($unit) {
                       return $unit->productive_unit_warehouses->map(function ($relation) {
                           return [
                               'id' => $relation->warehouse_id,
                               'name' => $relation->warehouse->name,
                           ];
                       });
                   });
       
                   // Realiza una consulta para obtener las unidades productivas relacionadas con 'Almacen'
                   $units = ProductiveUnit::whereHas('productive_unit_warehouses', function ($query) use ($wer) {
                       $query->where('id', $this->selectedUnitId);
                   })->get();
                   
                   // Ahora, puedes obtener los IDs y nombres de las bodegas relacionadas con las unidades productivas
                   $receivewarehouse = $units->flatMap(function ($unit) {
                       return $unit->productive_unit_warehouses->map(function ($relation) {
                           return [
                               'id' => $relation->warehouse_id,
                               'name' => $relation->warehouse->name,
                           ];
                       });
                   });
       
               }
       
               return view('agrocefa::movements.formexit', [
                   'people' => $people,
                   'date' => $date,
                   'werhousentrance' => $werhousentrance,
                   'receivewarehouse' => $receivewarehouse,
               ]);
        
    }
}

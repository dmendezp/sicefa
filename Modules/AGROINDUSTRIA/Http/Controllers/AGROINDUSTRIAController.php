<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;
use Modules\AGROINDUSTRIA\Entities\Utensil;
use DB;

class AGROINDUSTRIAController extends Controller
{
    public function index()
    {
        $title = 'Inicio';
        return view('agroindustria::index', compact('title'));
    }

    public function unidd()
    {
       if(Auth::check()){
            $user = Auth::user();
            if ($user->roles->contains('slug', 'agroindustria.admin') || $user->roles->contains('slug', 'agroindustria.instructor.vilmer') || $user->roles->contains('slug', 'agroindustria.instructor.chocolate')) {
                $responsibilities = $user->roles->flatMap(function ($role) {
                    return $role->responsibilities->pluck('activity_id');
                });

                 // Obtiene los IDs de las unidades productivas basadas en las actividades
                $units = Activity::whereIn('id', $responsibilities)
                ->pluck('productive_unit_id');

                // Obtiene las unidades productivas a partir de los IDs obtenidos
                $productiveUnits = ProductiveUnit::whereIn('id', $units)
                ->get();

                 // Retorna la vista 'homeproductive_units' con datos de unidades y la unidad seleccionada
                return view('agroindustria::units', [
                    'units' => $productiveUnits,
                    'title' => 'Unidad'
                ])->with('noRecords', $productiveUnits->isEmpty());
            }
        }
    }

    public function recipes()
    {
        $utensils = Utensil::all();
        $ingredients = Ingredient::all();
        $formulations = Formulation::all();
        $title = 'Recetas';
        return view('agroindustria::instructor.formulations.recipes', compact('title','formulations','ingredients','utensils'));  
    }
    public function navbarUnit()
    {
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);
        return view('agroindustria::layouts.partiasl.navbar', compact('title', 'unitName'));
    }

    public function enviarsolicitud()
    {
        $title = 'Enviar Solicitud';
        return view('agroindustria::instructor.enviarsolicitud', compact('title'));
    }

    public function invb()
    {
        $title = 'Inventario';
        return view('agroindustria::intern.invb', compact('title'));
    }

    public function dashboard()
    {
        $title = 'Dasboard';
        return view('agroindustria::admin.dashboard', compact('title'));
    }

}

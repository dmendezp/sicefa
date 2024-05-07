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
use Modules\SICA\Entities\Labor;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;
use Modules\AGROINDUSTRIA\Entities\Utensil;
use DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

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
            if ($user->roles->contains('slug', 'superadmin') || $user->roles->contains('slug', 'agroindustria.admin') || $user->roles->contains('slug', 'agroindustria.instructor.vilmer') || $user->roles->contains('slug', 'agroindustria.instructor.chocolate') || $user->roles->contains('slug', 'agroindustria.instructor.cerveceria') || $user->roles->contains('slug', 'agroindustria.almacenista')) {

                $productiveUnitsid = $user->roles->flatMap(function ($role){
                    return $role->productive_units->pluck('id');
                     
                });

                if (checkRol('superadmin')) {
                    // Obtiene las unidades productivas a partir de los IDs obtenidos
                    $productiveUnits = ProductiveUnit::get();
                } else {
                    // Obtiene las unidades productivas a partir de los IDs obtenidos
                    $productiveUnits = ProductiveUnit::whereIn('id', $productiveUnitsid)
                    ->get();
                }

                
                 // Retorna la vista 'homeproductive_units' con datos de unidades y la unidad seleccionada
                return view('agroindustria::units', [
                    'units' => $productiveUnits,
                    'title' => 'Unidad'
                ])->with('noRecords', $productiveUnits->isEmpty());
            }
        }
    }

    public function developments(){
        $title = 'Desarrolladores';
        return view('agroindustria::developments', compact('title'));
    }

    public function manual()
    {
        // Ruta al archivo PDF
        $rutaPdf = public_path('modules\agroindustria\Manual de usuario - AGROINDUSTRIA.pdf');

        // Nombre que tendrá el archivo descargado
        $nombreArchivo = 'Manual de usuario - AGROINDUSTRIA.pdf';

        // Headers para indicar que es un archivo PDF
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Descarga el archivo
        return Response::download($rutaPdf, $nombreArchivo, $headers);
    }

    public function recipes()
    {
        $title = 'Recetas';
        $formulations = Formulation::with('utensils.element.measurement_unit', 'ingredients.element.measurement_unit')->get();

        $data = [
            'title' => $title,
            'formulations' => $formulations
        ];
        return view('agroindustria::instructor.formulations.recipes', $data);  
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

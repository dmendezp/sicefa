<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; 
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Spatie\Permission\Models\Role;


class AGROCEFAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    // Verifica si el usuario está autenticado
    public function index()
    {
        // Verifica si el usuario está autenticado
    if (Auth::check()) {
        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario tiene roles de "Administrador" o "Pasante"
        if ($user->roles->contains('name', 'Administrador') || $user->roles->contains('name', 'Pasante')) {
            // Obtiene las responsabilidades relacionadas con los roles del usuario
            $responsibilities = $user->roles->flatMap(function ($role) {
                return $role->responsibilities->pluck('activity_id');
            });

            // Obtiene los IDs de las unidades productivas basadas en las actividades
            $units = Activity::whereIn('id', $responsibilities)
                             ->pluck('productive_unit_id');

            // Obtiene las unidades productivas a partir de los IDs obtenidos
            $productiveUnits = ProductiveUnit::whereIn('id', $units)
                                             ->get();

            // Obtiene el ID de la unidad seleccionada desde la sesión
            $selectedUnitId = Session::get('selectedUnitId');

            // Retorna la vista 'homeproductive_units' con datos de unidades y la unidad seleccionada
            return view('agrocefa::homeproductive_units', [
                'units' => $productiveUnits,
                'selectedUnitId' => $selectedUnitId, // Pasar el ID de unidad seleccionado a la vista
            ]);
        }
    } else {
        // Si el usuario no está autenticado, muestra la vista 'homeproductive_units' sin datos especiales
        return view('agrocefa::home');
    }
    }
    public function selectUnit($id)
    {


        // Actualiza la variable de sesión con el nuevo ID de unidad seleccionado
        Session::put('selectedUnitId', $id);
        $unit = ProductiveUnit::find($id);

        // Verifica si se encontró la unidad
        if (!$unit) {
            // Maneja la situación en la que no se encuentra la unidad
            return redirect()->route('agrocefa.home')->with('error', 'La unidad productiva no se encontró');
        }
    
        // Obtén el nombre de la unidad
        $unitName = $unit->name;
    
        Session::put('selectedUnitName', $unitName);

        // Redirige a la vista de inicio con el ID de unidad seleccionado
        return redirect()->route('agrocefa.home');
    }


    public function home()
    {
    // Puedes acceder al ID de unidad seleccionado desde la sesión si lo necesitas
    $selectedUnitId = Session::get('selectedUnitId');

    // Obtener el nombre de la unidad a través del modelo ProductiveUnit
    $selectedUnitName = ProductiveUnit::where('id', $selectedUnitId)->value('name');

    // Realiza cualquier lógica adicional que necesites para esta vista

    // Retornar la vista deseada
    return view('agrocefa::home', [
        'selectedUnitName' => $selectedUnitName,
    ]);
    }
    public function movements()
    {   
        return view('agrocefa::movements');
    }

    public function insumos()
    {
        return view('agrocefa::insumos');
    }

    public function bodega()
    {
        return view('agrocefa::formulariocultivo');
    }

    public function inventory()
    {
        return view('agrocefa::inventory');
    }

    public function parameters()
    {
        return view('agrocefa::parameters');
    }

    public function vistaaprendiz()
    {
        return view('agrocefa::index');
    }

    public function vistauser()
    {
        return view('agrocefa::index');
    }

    public function crop()
    {
        return view('agrocefa::crop');
    }




}

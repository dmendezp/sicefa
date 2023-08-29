<?php

namespace Modules\AGROCEFA\Http\Controllers;

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

     public function index()
     {
         if (Auth::check()) {
             $user = Auth::user();
 
             if ($user->roles->contains('name', 'Administrador') || $user->roles->contains('name', 'Pasante')) {
                 $responsibilities = $user->roles->flatMap(function ($role) {
                     return $role->responsibilities->pluck('activity_id');
                 });
 
                 $units = Activity::whereIn('id', $responsibilities)
                                  ->pluck('productive_unit_id');
 
                 // Obtener las unidades productivas a partir de los IDs de las actividades
                 $productiveUnits = ProductiveUnit::whereIn('id', $units)
                                                  ->get();
 
                 return view('agrocefa::homeproductive_units', ['units' => $productiveUnits]);
             }
         } else {
            return view('agrocefa::homeproductive_units');
         }
    }

     public function home($id)
    {
        $unit = ProductiveUnit::find($id);

        return view('agrocefa::index', ['unitId' => $id, 'unit' => $unit]);
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

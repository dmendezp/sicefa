<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Element;

class LaborManagementController extends Controller
{


    public function create()
{
    $activityNames = Activity::pluck('name', 'id');
    $elementNames = Element::pluck('name', 'id'); // Asumiendo que Tool es el modelo para las herramientas
    return view('agrocefa::labormanagement.culturalwork', compact('activityNames', 'elementNames'));
}

    



    //rutas de la vista de las tarjetas y la de labores culturales
    public function index()
    {
        return view('agrocefa::labormanagement.index');
    }

    public function culturalwork()
    {
        return view('agrocefa::labormanagement.culturalwork');
    }
    
    public function agrochemicals()
    {
        return view('agrocefa::labormanagement.agrochemicals');
    }

    public function fertilizers()
    {
        return view('agrocefa::labormanagement.fertilizers');
    }

}

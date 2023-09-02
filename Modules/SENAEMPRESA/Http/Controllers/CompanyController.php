<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function contact()
    {
        $data = ['title' => 'Contactos'];
        return view('senaempresa::Company.contact', $data);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vacant()
    {
        $data = ['title' => 'Postulados'];
        return view('senaempresa::Company.Postulate.postulate', $data);
    }
    public function seleccionados()
    {
        $data = ['title' => 'Seleccionados'];
        return view('senaempresa::Company.Postulate.Application', $data);
    }
    public function mostrar_asociados()
    {
        $courses = Course::with('vacancy')->get();

        return view('senaempresa::Company.Vacant.courses_senaempresa', compact('courses'));
    }
}

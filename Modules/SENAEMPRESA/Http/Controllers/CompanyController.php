<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\senaempresa;
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
    public function seleccionados()
    {
        $data = ['title' => 'Seleccionados'];
        return view('senaempresa::Company.Postulate.Application', $data);
    }
}

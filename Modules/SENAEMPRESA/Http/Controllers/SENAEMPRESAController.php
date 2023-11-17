<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\CourseSenaempresa;
use Modules\SICA\Entities\Quarter;


class SENAEMPRESAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = ['title' => trans('senaempresa::menu.Home')];
        return view('senaempresa::index', $data);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function Developers()
    {
        $data = ['title' => trans('senaempresa::menu.Developers')];
        return view('senaempresa::Company.developers', $data);
    }

    public function Admin()
    {
        $data = ['title' => 'Administrador'];
        return view('senaempresa::Company.admin', $data);
    }
    public function Pasante()
    {
        $data = ['title' => 'Pasante'];
        return view('senaempresa::Company.pasante', $data);
    }
    public function Usuario()
    {
        $data = ['title' => 'Usuario'];
        return view('senaempresa::index', $data);
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

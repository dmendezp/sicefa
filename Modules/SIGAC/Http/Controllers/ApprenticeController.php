<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SIGAC\Entities\Point;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;

class ApprenticeController extends Controller
{
    /* Enviar Excusas */
    public function send_excuses()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_send_excuses_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_send_excuses_title_view')];
        return view('sigac::apprentice.send_excuses',$view);
    }
    public function apprentice()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_apprentices_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_apprentices_title_view')];
        return view('sigac::apprentice.apprentices',compact('view'));
    }
    public function index()
{
    // Obtener los datos
    $points = Point::with('apprentice.person', 'program')->get();
    $courses = Course::all();

    // Definir la variable $datos
    $datos = [
        'points' => $points,
        'courses' => $courses,
        'view' => [
            'titlePage' => trans('sigac::controllers.SIGAC_pointsApprentice_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_assignpoints_title_view'),
        ]
    ];

    // Retornar la vista
    return view('sigac::points.apprentice', $datos);
}
}

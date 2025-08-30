<?php

namespace Modules\SIA\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SIA\Entities\EventSia;
use Modules\SIA\Entities\Publication;

class SIAController extends Controller
{
    public function index()
    {
        // Trae los 6 próximos eventos ordenados por fecha de inicio
        $events = EventSia::orderBy('start_date', 'asc')->take(6)->get();

        // Trae las 6 publicaciones más recientes (ajusta el modelo si es necesario)
        $publications = class_exists(Publication::class)
            ? Publication::orderBy('publication_date', 'desc')->take(6)->get()
            : collect();

        $view = ['titlePage' => trans('sia::controllers.SIA_index_title_page'), 'titleView' => trans('sia::controllers.SIA_index_title_view')];
        return view('sia::index', compact('view', 'events', 'publications'));
    }

    public function devs()
    {
        $view = ['titlePage' => trans('sia::controllers.SIA_devs_title_page'), 'titleView' => trans('sia::controllers.SIA_devs_title_view')];
        return view('sia::developers.index', compact('view'));
    }

    public function info()
    {
        $view = ['titlePage' => trans('sia::controllers.SIA_info_title_page'), 'titleView' => trans('sia::controllers.SIA_info_title_page')];
        return view('sia::information.index', compact('view'));
    }

    public function admin()
    {
        $view = ['titlePage' => trans('sia::controllers.SIA_admin_title_page'), 'titleView' => trans('sia::controllers.SIA_admin_title_view')];

        // Trae las 6 publicaciones más recientes, sin importar su estado
        $publications = Publication::orderBy('publication_date', 'desc')->take(6)->get();

        // Trae los 6 próximos eventos (que aún no han comenzado)
        $events = EventSia::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(6)->get();

        return view('sia::admin-index', compact('view', 'publications', 'events'));
    }
}
<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\intern;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Labor;

class RequestController extends Controller
{
    public function index()
    {
        $title = 'Solicitudes';

        $requests = Labor::with('consumables.inventory.element', 'person')->where('status', 'Programado')->get();

        $data = [
            'title' => $title,
            'requests' => $requests
        ];
        return view('agroindustria::storer.request.index', $data);
    }

}

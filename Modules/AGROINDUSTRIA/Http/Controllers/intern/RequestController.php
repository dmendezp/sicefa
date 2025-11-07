<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\intern;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Activity;

class RequestController extends Controller
{
    public function index(){
        $title = 'Solicitudes';
        $selectedUnit = session('viewing_unit');

        $activities = Activity::where('productive_unit_id', $selectedUnit)->pluck('id');

        $requests = Labor::with('consumables.inventory.element', 'person')->whereIn('activity_id', $activities)->get();

        $data = [
            'title' => $title,
            'requests' => $requests
        ];
        return view('agroindustria::storer.request.index', $data);
    }

}

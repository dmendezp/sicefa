<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ComsumptionController extends Controller
{

    public function viewconsumption()
    {
        return view('agrocefa::reports.consumption');
    }

    
}

<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UnitController extends Controller
{
    public function unidd(){
        $title = 'Unidades';
        return view('agroindustria::instructor.unidd', compact('title'));
    }
}

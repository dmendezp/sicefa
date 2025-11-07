<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Unit;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;

class ChocolateriaController extends Controller
{
    public function chocolateria($unit)
    {
        session(['viewing_unit' => $unit]);
        $title = 'Chocolateria';
        $selectedUnit = ProductiveUnit::findOrFail($unit);
        session(['viewing_unit_name' => $selectedUnit->name]);
        return view('agroindustria::units.chocolateria',compact('title', 'selectedUnit'));
    }

}

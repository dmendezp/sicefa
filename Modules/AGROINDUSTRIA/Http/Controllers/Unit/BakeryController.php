<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\unit;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Modules\SICA\Entities\ProductiveUnit;

class BakeryController extends Controller
{
    public function bakery($unit)
    {
        session(['viewing_unit' => true]);
        $title = 'Panaderia';
        $result = app(AGROINDUSTRIAController::class)->unidd();
        $units = $result['units'];        
        $selectedUnit = ProductiveUnit::findOrFail($unit);
        
        // Eliminar la variable de sesión después de usarla y antes de cargar la vista
    
        return view('agroindustria::units.bakery.index', compact('title', 'selectedUnit'))->with('viewing_unit', true);
    }
    

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('agroindustria::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('agroindustria::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('agroindustria::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

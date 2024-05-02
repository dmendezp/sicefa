<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Unit;

use Illuminate\Routing\Controller;
use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Modules\SICA\Entities\ProductiveUnit;


class PasteleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index_pasteleria($unit)
    {
        session(['viewing_unit' => $unit]);
        $title = 'Pasteleria';
        $result = app(AGROINDUSTRIAController::class)->unidd();
        $units = $result['units'];        
        $selectedUnit = ProductiveUnit::findOrFail($unit);
        return view('agroindustria::units.pasteleria.index',compact('title', 'selectedUnit'));
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

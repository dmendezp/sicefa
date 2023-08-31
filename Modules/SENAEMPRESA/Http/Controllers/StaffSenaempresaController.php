<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SICA\Entities\Apprentice;

class StaffSenaempresaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function Per()
    {
        $staff_senaempresas = StaffSenaempresa::get();
        $data = ['title' => 'Personal', 'staff_senaempresas' => $staff_senaempresas];
         return view('senaempresa::staff_senaempresa.staff', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function registro()
    {
        $staff_senaempresas = StaffSenaempresa::get();
        $PositionCompany = PositionCompany::all();
        $data = ['title' => 'Nueva Vacante', 'vacastaff_senaempresasncies' => $staff_senaempresas, 'PositionCompany' => $PositionCompany];
        return view('senaempresa::staff_senaempresa.staff_registration', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $staffsenaempresa = new StaffSenaempresa();
        $staffsenaempresa->position_company_id = $request->input('position_company_id');
        $staffsenaempresa->apprentice_id = $request->input('apprentice_id');
    
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('senaempresa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('senaempresa::edit');
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

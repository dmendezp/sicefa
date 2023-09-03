<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\SENAEMPRESA\Entities\Loan;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SICA\Entities\Inventory;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function new()
    {
        $data = ['title' => 'Nuevo'];
        return view('senaempresa::Company.Loan.new', $data);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function register()
    {
        $loans = Loan::get();
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $inventories = Inventory::with('Element')->get();
        $data = ['title' => 'Prestamos Registrados', 'loans' => $loans, 'staff_senaempresas' => $staff_senaempresas, 'inventories' => $inventories];
        return view('senaempresa::Company.Loan.loan', $data);
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

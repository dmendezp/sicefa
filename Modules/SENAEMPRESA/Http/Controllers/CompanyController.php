<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function contact()
    {
        $data = ['title' => 'Contactos'];
        return view('senaempresa::Company.contact', $data);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vacantes()
    {
        $data = ['title' => 'Vacantes'];
        return view('senaempresa::Company.Vacant.vacant', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function registration()
    {
        $data = ['title' => 'Nueva Vacante'];
        return view('senaempresa::Company.Vacant.registration', $data);
    }

    public function vacant()
    {
        $data = ['title' => 'Postulados'];
        return view('senaempresa::Company.Postulate.postulate', $data);
    }
    public function seleccionados()
    {
        $data = ['title' => 'Seleccionados'];
        return view('senaempresa::Company.Postulate.Application', $data);
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
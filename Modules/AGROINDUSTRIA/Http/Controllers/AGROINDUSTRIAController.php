<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class AGROINDUSTRIAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $title = 'Inicio';
        return view('agroindustria::index', compact('title'));
    }

    public function unidd()
    {
        $title = 'Unidades';
        return view('agroindustria::unidd', compact('title'));
    }

    public function solicitud()
    {
        $title = 'Solicitud';
        return view('agroindustria::solicitud', compact('title'));
    }

    public function invb()
    {
        $title = 'Inventario';
        return view('agroindustria::invb', compact('title'));
    }

    public function enviarsolicitud()
    {
        $title = 'Enviar Solicitud';
        return view('agroindustria::enviarsolicitud', compact('title'));
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

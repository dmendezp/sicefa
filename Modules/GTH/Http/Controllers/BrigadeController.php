<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Asistencias;


class BrigadeController extends Controller
{

        public function viewBrigader()
    {
        $asistencias = Asistencias::all();
        return view('brigade.asistencia', compact('asistencias'));
    }

    public function generateReport()
    {
        $reporte = [
            'area' => person::groupBy('area')->get(),
            'ficha' => Asistencias::groupBy('ficha')->get(),
            // Agrega otras consultas según tus necesidades
        ];

        return view('brigade.reporte', compact('reporte'));
    }


    // Otros métodos del controlador..


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('gth::create');
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
        return view('gth::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('gth::edit');
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

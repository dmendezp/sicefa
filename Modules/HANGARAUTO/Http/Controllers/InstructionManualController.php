<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InstructionManualController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function manual()
    {
        $pdfPath1 = asset('modules/HANGARAUTO/manual/HANGARAUTO _ Panel Del Administrador.pdf');
        $pdfPath2 = asset('modules/HANGARAUTO/manual/Encargado.pdf');

        
        return view('hangarauto::Instruction_manual.manual', compact('pdfPath2', 'pdfPath1', ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hangarauto::create');
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
        return view('hangarauto::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hangarauto::edit');
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

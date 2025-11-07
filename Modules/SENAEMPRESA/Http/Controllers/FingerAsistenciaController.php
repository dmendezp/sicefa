<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SENAEMPRESA\Entities\FingerAsistencia;
use Modules\SENAEMPRESA\Imports\FingerAsistenciaImport;
use Maatwebsite\Excel\Facades\Excel;


class FingerAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $asistencias = FingerAsistencia::get();
        return view('senaempresa::Asistencia_Finger/home',['asistencia' => $asistencias]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('senaempresa::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function import(Request $request )
    {

       

        if($request->hasFile('file')){

            $excel = $request->file('file');
            
            $retorno = Excel::import(new FingerAsistenciaImport, $excel);

            
            return redirect()->route('fingerPrint.home')->with('success', 'All good!');

            
        }else{
            return redirect()->route('fingerPrint.home')->with('message', 'The file do not upload');
        }
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

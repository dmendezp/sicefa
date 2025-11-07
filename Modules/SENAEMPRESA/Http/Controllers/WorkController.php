<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\Work;
use Modules\SICA\Entities\ProductiveUnit;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $works = Work::get();
        return view('senaempresa::Work.home', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $productive_units = ProductiveUnit::get();
        return view('senaempresa::Work.create', compact('productive_units'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $work = new Work;
        $work->name = e($request->input('name'));
        $work->description = e($request->input('description'));
        $work->productive_unit_id = e($request->input('productive')); 
        $card = 'card-works';
        if($work->save()){
            $icon = 'success';
            $message = 'Tarea Creada.';
        }else{
            $icon = 'error';
            $message = 'No se pudo crear la tarea.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message'=>$message]);
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
    public function workEdit($id)
    {
        $work = Work::findOrFail($id);
        $productive_units = ProductiveUnit::get();
        return view('senaempresa::Work.edit', compact('productive_units','work'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function workUpdate(Request $request)
    {
        $work = Work::findOrFail($request->input('id'));
        $work->name = e($request->input('name'));
        $work->description = e($request->input('description'));
        $work->productive_unit_id = e($request->input('productive')); 
        $card = 'card-works';
        if($work->save()){
            $icon = 'success';
            $message = 'Tarea Actualizada.';
        }else{
            $icon = 'error';
            $message = 'No se pudo actualizar la tarea.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message'=>$message]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function workDelete($id)
    {
        $work = Work::findOrFail($id);
        return view('senaempresa::Work.delete', compact('work'));
    }

    public function workDestroy(Request $request)
    {
        $work = Work::findOrFail($request->input('id'));
        $card = 'card-works';
        if($work->delete()){
            $icon = 'success';
            $message = 'Tarea eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message = 'No se pudo eliminar la tarea.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message'=>$message]);   
    }
}

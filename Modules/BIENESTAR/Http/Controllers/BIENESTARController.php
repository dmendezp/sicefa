<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BIENESTARController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('bienestar::index');
    }
    public function Drivers_view()
    {
        return view('bienestar::Drivers_view');
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bienestar::create');
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
        return view('bienestar::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bienestar::edit');
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
    public function APEalimentacion()
    {
        return view('bienestar::APEalimentacion');
    }
    public function APEinterno()
    {
        return view('bienestar::APEinterno');
    }
    public function APEsena()
    {
        return view('bienestar::APEsena');
    }
    public function APEtransporte()
    {
        return view('bienestar::APEtransporte');
    }
    public function HISeventos()
    {
        return view('bienestar::HISeventos');
    }
    public function home()
    {
        return view('bienestar::home');
    }
    public function LIDretorant()
    {
        return view('bienestar::LIDretorant');
    }
    public function SCANrestorant()
    {
        return view('bienestar::SCANrestorant');
    }
    public function SCANrutas()
    {
        return view('bienestar::SCANrutas');
    }
    public function APEformulario()
    {
        return view('bienestar::APEformulario');
    }
    public function LIDrutas()
    {
        return view('bienestar::LIDrutas');
    }
    public function buses()
    {
        return view('bienestar::buses');
    }
    
    

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    
}

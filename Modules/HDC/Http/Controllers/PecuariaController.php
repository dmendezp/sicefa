<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PecuariaController extends Controller
{

    public function index()
    {
        return view('hdc::index');
    }
    public function bovinos(){

        return view('hdc::pecuaria.bovinos');
    }
    public function equinos(){

        return view('hdc::pecuaria.equinos');
    }
    public function ovinos(){

        return view('hdc::pecuaria.ovinos');
    }
    public function piscicola(){

        return view('hdc::pecuaria.piscicola');
    }
    public function porcinos(){

        return view('hdc::pecuaria.porcinos');
    }



    public function create()
    {
        return view('hdc::create');
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
        return view('hdc::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hdc::edit');
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

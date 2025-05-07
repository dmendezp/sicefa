<?php

namespace Modules\GDF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GDF\Entities\Activitie;
use Modules\GDF\Entities\Certificate;
use Modules\GDF\Entities\Activities;

class GDFController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('gdf::index');
    }
    
    public function funcionario()
    {
        return view('gdf::welcome');
    }

    public function superadmin()
    {
        return view('gdf::welcome');
    }

    public function admin()
    {
        return view('gdf::admin.admin');
    }

    public function index_activities()
    {
        return view('gdf::crud.certificate.index', compact('certificates'));
    }
    public function create_activities()
    {
        return view('gdf::crud.certificate.create');
    }
    public function store_activities(Request $request)
    {
        $request->validate([
            'certified_code' => ['required', 'regex:/^\d{1,10}$/'], // Solo números, máximo 10 dígitos
            'issue_date' => ['required', 'date'],
            'official_id' => ['required', 'regex:/^\d{1,10}$/'], // Solo números, máximo 10 dígitos
            'description' => ['required', 'string', 'max:1000'],
        ], [
            'certified_code.regex' => 'El código debe contener solo números (máximo 10 dígitos).',
            'official_id.regex' => 'La cédula debe contener solo números (máximo 10 dígitos).',
        ]);


        return redirect()->route('cefa.gdf.index_certificate')->with('success', 'El Certificado se ha registrado correctamente.');
    }


    public function aprobar_activities(Request $request, $id)
    {
        $certificate->state = 'aprobado';
        $certificate->save();

        return redirect()->route('cefa.gdf.index_certificate')->with('success', ' 📌 Certificado aprobado.');
    }

    public function rechazar_activities($id)
    {
        $certificate->state = 'rechazado';
        $certificate->save();

        return redirect()->back()->with('error', ' 📌 Certificado rechazado.');
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('gdf::create');
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
        return view('gdf::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('gdf::edit');
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

<?php

namespace Modules\GDF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GDF\Entities\Certificate;

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
    public function admin()
    {
        return view('gdf::admin.admin');
    }

    public function index_certificate()
    {
        $certificates = Certificate::all();
        return view('gdf::crud.certificate.index', compact('certificates'));
    }
    public function create_certificate()
    {
        return view('gdf::crud.certificate.create');
    }
    public function store_certificate(Request $request)
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

        Certificate::create($request->all());

        return redirect()->route('cefa.gdf.index_certificate')->with('success', 'El Certificado se ha registrado correctamente.');
    }
    public function edit_certificate($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('gdf::crud.certificate.edit', compact('certificate'));
    }
    
    public function update_certificate(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'certified_code' => 'required|digits_between:1,10',
            'issue_date' => 'required|date',
            'official_id' => 'required|digits_between:1,10',
            'description' => 'required|string|max:1000',
        ]);

        $certificate = Certificate::findOrFail($id);
        $certificate->update($request->all());
    
        return redirect()->route('cefa.gdf.index_certificate')->with('success', '📌 Certificado actualizado con éxito.');
    }
    
    public function destroy_certificate($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
    
        return redirect()->route('cefa.gdf.index_certificate')->with('success', '📌 Certificado eliminado con éxito.');
        
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

<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\PositionCompany;

class PositionCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function cargar()
{
    $position_companies = PositionCompany::get();
    $data = [
        'title' => trans('senaempresa::menu.Positions'),
        'position_companies' => $position_companies
    ];
    return view('senaempresa::Company.PositionCompany.position', $data);
}


    public function registro()
    {
        $position_companies = PositionCompany::all();
        $data = ['title' => trans('senaempresa::menu.New Position'), 'position_companies' => $position_companies];
        return view('senaempresa::Company.PositionCompany.position_registration', $data);
    }

   public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'state' => 'required|in:activo,inactivo', // Agrega la validación aquí
    ]);

    $name = $request->input('name');

    // Buscar un registro eliminado por soft delete con el mismo valor en "requirement"
    $existingPositionCompany = PositionCompany::withTrashed()
        ->where('name', $name)
        ->first();

    if ($existingPositionCompany && $existingPositionCompany->trashed()) {
        // Si el registro existe y está eliminado por soft delete, restaurarlo
        $existingPositionCompany->restore();
        return redirect()->route('company.position.cargos')->with('success', trans('senaempresa::menu.Position successfully restored'));
    } elseif ($existingPositionCompany) {
        // Si el registro existe pero no está eliminado, mostrar un mensaje de error
        return redirect()->back()->with('error', trans('senaempresa::menu.The position already exists in the database'));
    }

    // Si no se encuentra ningún registro existente, crear uno nuevo
    $positionCompany = new PositionCompany();
    $positionCompany->name = $request->input('name');
    $positionCompany->description = $request->input('description');
    $positionCompany->state = $request->input('state');

    if ($positionCompany->save()) {
        return redirect()->route('company.position.cargos')->with('success', trans('senaempresa::menu.Position successfully created'));
    }
}

    
    public function edit($id)
    {


        $position = PositionCompany::find($id);
        $data = ['title' => trans('senaempresa::menu.Edit the position.'), 'position' => $position];
        return view('senaempresa::Company.PositionCompany.position_edit', $data);
    }
    public function update(Request $request, $id)
    {
        $position = PositionCompany::find($id);
        $position->name = $request->input('name');
        $position->description = $request->input('description');
        $position->state = $request->input('state'); // Obtener el valor seleccionado del select

        // Actualiza otros campos según necesites
        $position->save();

        return redirect()->route('company.position.cargos')->with('success', trans('senaempresa::menu.Registration successfully updated.'));
    }
    public function destroy($id)
    {
        try {
            $company = PositionCompany::findOrFail($id);
            $company->delete();

            return response()->json(['mensaje' => trans('senaempresa::menu.Position eliminated with success.')]);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => trans('senaempresa::menu.Error in eliminating the position.')], 500);
        }
    }
}
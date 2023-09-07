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
        $positionCompany = new PositionCompany();


        $validatedData = $request->validate([
            'requirement' => 'required',
            'description' => 'required',
            'state' => 'required',
        ]);

        // Verifica si el objeto se creó correctamente antes de asignar propiedades
        if ($positionCompany) {
            $positionCompany->requirement = $request->input('requirement');
            $positionCompany->description = $request->input('description');
            $positionCompany->state = $request->input('state'); // Obtener el valor seleccionado del select

            if ($positionCompany->save()) {
                // Redirigir a la vista adecuada con un mensaje de éxito
                return redirect()->route('cefa.cargos')->with('success', trans('senaempresa::menu.Position successfully created.'));
            } else {
                // Manejar el caso de error si la inserción falla
                return redirect()->back()->with('error', trans('senaempresa::menu.Error in creating the position.'));
            }
        } else {
            return redirect()->back()->with('error', trans('senaempresa::menu.Failed to create PositionCompany object.'));
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
        $position->requirement = $request->input('requirement');
        $position->description = $request->input('description');
        $position->state = $request->input('state'); // Obtener el valor seleccionado del select

        // Actualiza otros campos según necesites
        $position->save();

        return redirect()->route('cefa.cargos')->with('warning', trans('senaempresa::menu.Registry successfully updated'));
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

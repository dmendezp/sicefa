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
        $data = ['title' => 'Cargos', 'position_companies' => $position_companies];
        return view('senaempresa::Company.PositionCompany.position', $data);
    }

    public function registro()
    {
        $position_companies = PositionCompany::all();
        $data = ['title' => 'Nuevo Cargo', 'position_companies' => $position_companies];
        return view('senaempresa::Company.PositionCompany.position_registration', $data);
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
                return redirect()->route('carga')->with('success', 'Cargo creado exitosamente.');
            } else {
                // Manejar el caso de error si la inserción falla
                return redirect()->back()->with('error', 'Error al crear el cargo.');
            }
        } else {
            return redirect()->back()->with('error', 'Error al crear el objeto PositionCompany.');
        }
    }
    public function edit($id)
    {


        $position = PositionCompany::find($id);
        $data = ['title' => 'Editar', 'position' => $position];
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

        return redirect()->route('carga')->with('success', 'Registro actualizado exitosamente.');
    }
    public function destroy($id)
    {
        $company = PositionCompany::find($id);

        if (!$company) {
            return redirect()->route('carga')->with('error', 'El cargo no existe.');
        }

        if ($company->delete()) {
            return redirect()->route('carga')->with('success', 'Cargo eliminado exitosamente.');
        } else {
            return redirect()->route('carga')->with('error', 'Error al eliminar el cargo.');
        }
    }
}

<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SICA\Entities\Apprentice;



class StaffSenaempresaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function Per()
    {
        $PositionCompany = PositionCompany::all();
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $data = ['title' => 'Personal', 'staff_senaempresas' => $staff_senaempresas, 'PositionCompany' => $PositionCompany];
        return view('senaempresa::staff_senaempresa.staff', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function registro()
    {
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $PositionCompany = PositionCompany::all();
        $data = ['title' => 'Personal SenaEmpresa', 'vacastaff_senaempresasncies' => $staff_senaempresas, 'PositionCompany' => $PositionCompany];
        return view('senaempresa::staff_senaempresa.staff_registration', $data);
    }

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
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'position_company_id' => 'required',
            'apprentice_id' => 'required',
            // Agrega aquí las reglas de validación para los otros campos
        ]);

        // Crea una nueva instancia del modelo StaffSenaempresa
        $staffSenaempresa = new StaffSenaempresa();

        // Asigna los valores de los campos del formulario a la instancia
        $staffSenaempresa->position_company_id = $request->input('position_company_id');
        $staffSenaempresa->apprentice_id = $request->input('apprentice_id');
        // Asigna aquí los valores de los otros campos

        // Guarda la instancia en la base de datos
        if ($staffSenaempresa->save()) {
            // Redirige a la vista adecuada con un mensaje de éxito
            return redirect()->route('personal')->with('success', 'Cargo creado exitosamente.');
        } else {
            // Maneja el caso de error si la inserción falla
            return redirect()->back()->with('error', 'Error al crear el cargo.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editar($id)
    {

        $staffSenaempresa = StaffSenaempresa::findOrFail($id);
        $PositionCompany = PositionCompany::all();
        $apprentices = Apprentice::all();

        $data = ['title' => 'Editar Personal', 'staffSenaempresa' => $staffSenaempresa, 'PositionCompany' => $PositionCompany, 'apprentices' => $apprentices  ];
        return view('senaempresa::staff_senaempresa.staff_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $staffSenaempresa = StaffSenaempresa::find($id);
        $staffSenaempresa->position_company_id = $request->input('position_company_id');
        $staffSenaempresa->apprentice_id = $request->input('apprentice_id'); // Obtener el valor seleccionado del select

        // Actualiza otros campos según necesites
        $staffSenaempresa->save();

        return redirect()->route('personal')->with('success', 'Registro actualizado exitosamente.');
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $company = StaffSenaempresa::find($id);

        if (!$company) {
            return redirect()->route('personal')->with('error', 'El cargo no existe.');
        }

        if ($company->delete()) {
            return redirect()->route('personal')->with('success', 'Cargo eliminado exitosamente.');
        } else {
            return redirect()->route('personal')->with('error', 'Error al eliminar el cargo.');
        }
    }
}

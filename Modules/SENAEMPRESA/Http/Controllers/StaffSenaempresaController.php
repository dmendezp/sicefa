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
    public function mostrar_personal()
    {
        $PositionCompany = PositionCompany::all();
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $data = ['title' => 'Personal', 'staff_senaempresas' => $staff_senaempresas, 'PositionCompany' => $PositionCompany];
        return view('senaempresa::Company.staff_senaempresa.staff', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function nuevo_personal()
    {
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $PositionCompany = PositionCompany::all();
        $Apprentices = Apprentice::all();
        $data = ['title' => 'Personal SenaEmpresa', 'vacastaff_senaempresasncies' => $staff_senaempresas, 'PositionCompany' => $PositionCompany, 'Apprentices' => $Apprentices];
        return view('senaempresa::Company.staff_senaempresa.staff_registration', $data);
    }

    public function personal_nuevo(Request $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');

        $staffSenaempresa = new StaffSenaempresa();
        $staffSenaempresa->position_company_id = $request->input('position_company_id');
        $staffSenaempresa->apprentice_id = $request->input('apprentice_id');
        $staffSenaempresa->image = $imagePath;

        // Guarda la instancia en la base de datos
        if ($staffSenaempresa->save()) {
            // Redirige a la vista adecuada con un mensaje de éxito
            return redirect()->route('cefa.personal')->with('success', 'Personal creado exitosamente.');
        } else {
            // Maneja el caso de error si la inserción falla
            return redirect()->back()->with('error', 'Error al crear el personal.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editar_personal($id)
    {

        $staffSenaempresa = StaffSenaempresa::findOrFail($id);
        $PositionCompany = PositionCompany::all();
        $apprentices = Apprentice::all();

        $data = ['title' => 'Editar Personal', 'staffSenaempresa' => $staffSenaempresa, 'PositionCompany' => $PositionCompany, 'apprentices' => $apprentices];
        return view('senaempresa::Company.staff_senaempresa.staff_edit', $data);
    }
    public function personal_editado(Request $request, $id)
    {
        $staffSenaempresa = StaffSenaempresa::find($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $staffSenaempresa->image = $imagePath;
        }
        $staffSenaempresa->position_company_id = $request->input('position_company_id');
        $staffSenaempresa->apprentice_id = $request->input('apprentice_id');
        $staffSenaempresa->save();

        return redirect()->route('cefa.personal')->with('warning', 'Registro actualizado exitosamente.');
    }
    public function destroy($id)
    {
        try {
            $company = StaffSenaempresa::findOrFail($id);
            $company->delete();

            return response()->json(['mensaje' => 'Personal eliminada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al eliminar la Personal'], 500);
        }
    }
}

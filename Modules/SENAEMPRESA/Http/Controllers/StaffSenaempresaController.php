<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
        $data = ['title' => trans('senaempresa::menu.Staff'), 'staff_senaempresas' => $staff_senaempresas, 'PositionCompany' => $PositionCompany];
        return view('senaempresa::Company.staff_senaempresa.staff', $data);
    }
    public function nuevo_personal()
    {
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $PositionCompany = PositionCompany::all();
        $Apprentices = Apprentice::all();
        $data = ['title' => trans('senaempresa::menu.Staff SenaEmpresa'), 'vacastaff_senaempresasncies' => $staff_senaempresas, 'PositionCompany' => $PositionCompany, 'Apprentices' => $Apprentices];
        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.staff_senaempresa.staff_registration', $data);
        } else {
            return redirect()->route('company.senaempresa.personal')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
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
            return redirect()->route('company.senaempresa.personal')->with('success', trans('senaempresa::menu.Staff successfully created.'));
        } else {
            // Maneja el caso de error si la inserción falla
            return redirect()->back()->with('error', trans('senaempresa::menu.Error in creating the staff.'));
        }
    }

    public function editar_personal($id)
    {

        $staffSenaempresa = StaffSenaempresa::findOrFail($id);
        $PositionCompany = PositionCompany::all();
        $apprentices = Apprentice::all();

        $data = ['title' => trans('senaempresa::menu.Edit Personal'), 'staffSenaempresa' => $staffSenaempresa, 'PositionCompany' => $PositionCompany, 'apprentices' => $apprentices];
        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.staff_senaempresa.staff_edit', $data);
        } else {
            return redirect()->route('company.senaempresa.personal')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
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

        return redirect()->route('company.senaempresa.personal')->with('success', trans('senaempresa::menu.Registration successfully updated.'));
    }
    public function destroy($id)
    {
        try {
            $company = StaffSenaempresa::findOrFail($id);
            $company->delete();

            return response()->json(['mensaje' => trans('senaempresa::menu.Staff eliminated with success')]);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => trans('senaempresa::menu.Error while deleting the Personal')], 500);
        }
    }
}

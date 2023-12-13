<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SICA\Entities\Apprentice;
use Illuminate\Support\Facades\File;




class StaffSenaempresaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function staff()
    {
        $PositionCompany = PositionCompany::all();
        $staff = StaffSenaempresa::with('Quarter')->get();
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->orderBy('quarter_id')->get();
        $data = ['title' => trans('senaempresa::menu.Staff'), 'staff_senaempresas' => $staff_senaempresas, 'PositionCompany' => $PositionCompany, 'staff' => $staff];
        return view('senaempresa::Company.staff_senaempresa.index', $data);
    }
    public function new()
    {
        $staffSenaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $positionCompany = PositionCompany::all();
        $senaempresas = Senaempresa::all(); // Asumiendo que Senaempresa es el nombre correcto del modelo
        $apprentices = Apprentice::whereHas('postulates', function ($query) {
            $query->where('state', 'Seleccionado');
        })->get();
    
        $selectedPosition = null;
        $selectedPositionName = null;
    
        if ($apprentices->isEmpty()) {
            return redirect()->back()->with('error', trans('senaempresa::menu.No apprentices selected'));
        } else {
            $firstApprentice = $apprentices->first();
            $postulate = $firstApprentice->postulates->first();
            $selectedPosition = $postulate->vacancy->position_company_id;
            $selectedPositionName = $postulate->vacancy->positionCompany->name;
        }
    
        $data = [
            'title' => trans('senaempresa::menu.Staff SenaEmpresa'),
            'vacastaff_senaempresasncies' => $staffSenaempresas,
            'PositionCompany' => $positionCompany,
            'Apprentices' => $apprentices,
            'senaempresas' => $senaempresas, // Nombre de la variable actualizado
            'selectedPosition' => $selectedPosition,
            'selectedPositionName' => $selectedPositionName,
        ];
    
        return view('senaempresa::Company.staff_senaempresa.new', $data);
    }
    



    public function saved(Request $request)
    {
        // Obtener el archivo de imagen del formulario
        if ($image = $request->file('image')) {
            $extension = $image->getClientOriginalExtension();
            $nameWithoutExtension = Str::slug($request->input('apprentice_id'));
            $name_image = $nameWithoutExtension . '_' . time() . '.' . $extension;
            $image->move(public_path('modules/senaempresa/images/staff/'), $name_image);
        }

        $staffSenaempresa = new StaffSenaempresa();
        $staffSenaempresa->position_company_id = $request->input('position_company_id');
        $staffSenaempresa->apprentice_id = $request->input('apprentice_id');
        $staffSenaempresa->quarter_id = $request->input('quarter_id');
        $staffSenaempresa->image = 'modules/senaempresa/images/staff/' . $name_image;

        // Guarda la instancia en la base de datos
        if ($staffSenaempresa->save()) {
            // Redirige a la vista adecuada con un mensaje de éxito
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.index')->with('success', trans('senaempresa::menu.Staff successfully created.'));
        } else {
            // Maneja el caso de error si la inserción falla
            return redirect()->back()->with('error', trans('senaempresa::menu.Error in creating the staff.'));
        }
    }

    public function edit($id)
    {

        $staffSenaempresa = StaffSenaempresa::findOrFail($id);
        $PositionCompany = PositionCompany::all();
        $apprentices = Apprentice::all();
        $quarters = Quarter::all();

        $data = ['title' => trans('senaempresa::menu.Edit Personal'), 'staffSenaempresa' => $staffSenaempresa, 'PositionCompany' => $PositionCompany, 'apprentices' => $apprentices, 'quarters' => $quarters];

        return view('senaempresa::Company.staff_senaempresa.edit', $data);
    }
    public function updated(Request $request, $id)
    {
        $staffSenaempresa = StaffSenaempresa::find($id);
        if ($request->hasFile('image')) {
            // Elimina la imagen existente si existe
            if (File::exists(public_path($staffSenaempresa->image))) {
                File::delete(public_path($staffSenaempresa->image));
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $nameWithoutExtension = Str::slug($request->input('apprentice_id'));
            $name_image = $nameWithoutExtension . '_' . time() . '.' . $extension;
            $image->move(public_path('modules/senaempresa/images/staff/'), $name_image);

            $staffSenaempresa->image = 'modules/senaempresa/images/staff/' . $name_image;
        }
        $staffSenaempresa->position_company_id = $request->input('position_company_id');
        $staffSenaempresa->apprentice_id = $request->input('apprentice_id');
        $staffSenaempresa->quarter_id = $request->input('quarter_id');
        $staffSenaempresa->save();

        return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.index')->with('success', trans('senaempresa::menu.Registration successfully updated.'));
    }
    public function delete($id)
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

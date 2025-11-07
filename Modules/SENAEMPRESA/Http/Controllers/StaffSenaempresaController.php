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
use Modules\SENAEMPRESA\Entities\SenaEmpresa;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\File;
use Modules\SICA\Entities\Quarter;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class StaffSenaempresaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function staff()
    {
        // Get the current date
        $currentDate = now();

        // Find the current quarter
        $currentQuarter = Quarter::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        // Find the next quarter
        $nextQuarter = Quarter::where('start_date', '>', $currentDate)
            ->orderBy('start_date', 'asc')
            ->first();

        $PositionCompany = PositionCompany::all();
        $staff = StaffSenaempresa::with('senaempresa')->get();
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->orderBy('senaempresa_id')->get();

        $data = [
            'title' => trans('senaempresa::menu.Staff'),
            'staff_senaempresas' => $staff_senaempresas,
            'PositionCompany' => $PositionCompany,
            'staff' => $staff,
            'currentQuarterId' => $currentQuarter ? $currentQuarter->id : null,
            'nextQuarterId' => $nextQuarter ? $nextQuarter->id : null,
        ];

        return view('senaempresa::Company.staff_senaempresa.index', $data);
    }
    public function new()
    {
        // Get the current date
        $currentDate = now();

        // Find the current quarter
        $currentQuarter = Quarter::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        if (!$currentQuarter) {
            // Handle the case where no current quarter is found
            return redirect()->back()->with('info', 'No se han encontrado un trimestre para la fecha actual');
        }

        // Find the next quarter
        $nextQuarter = Quarter::where('start_date', '>', $currentDate)
            ->orderBy('start_date', 'asc')
            ->first();

        // Check if there is a next quarter
        if (!$nextQuarter) {
            // If there is no next quarter, use the current quarter
            $nextQuarter = $currentQuarter;
        }

        // Retrieve senaempresas for the current quarter
        $currentSenaempresas = Senaempresa::where('quarter_id', $currentQuarter->id)->get();

        // Retrieve senaempresas for the next quarter
        $nextSenaempresas = Senaempresa::where('quarter_id', $nextQuarter->id)->get();

        // Merge senaempresas for both quarters
        $senaempresas = $currentSenaempresas->merge($nextSenaempresas);

        // Check if senaempresas is empty for both quarters
        if ($senaempresas->isEmpty()) {
            return redirect()->back()->with('info', 'No se han encontrado senaempresas para el trimestre actual o el siguiente');
        }

        $staffSenaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $positionCompany = PositionCompany::all();
        // Obtener todos los aprendices
        $apprentices = Apprentice::get();




        if ($apprentices->isEmpty()) {
            return redirect()->back()->with('info', trans('senaempresa::menu.No apprentices selected'));
        } else {
            $firstApprentice = $apprentices->first();
            $postulate = $firstApprentice->postulates->first();
            $selectedPosition = $postulate ? $postulate->vacancy->position_company_id : null;
            $selectedPositionName = $postulate ? $postulate->vacancy->positionCompany->name : null;
        }

        $data = [
            'title' => trans('senaempresa::menu.Staff SenaEmpresa'),
            'vacastaff_senaempresasncies' => $staffSenaempresas,
            'PositionCompany' => $positionCompany,
            'Apprentices' => $apprentices,
            'senaempresas' => $senaempresas,
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
        $staffSenaempresa->senaempresa_id = $request->input('senaempresa_id');
        $staffSenaempresa->image = 'modules/senaempresa/images/staff/' . $name_image;
        $staffSenaempresa->duration_total = '00:00:00';

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
        // Get the current date
        $currentDate = now();

        // Find the current quarter
        $currentQuarter = Quarter::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        if (!$currentQuarter) {
            // Handle the case where no current quarter is found
            // You can throw an exception or take other appropriate action here.
        }

        // Find the next quarter
        $nextQuarter = Quarter::where('start_date', '>', $currentDate)
            ->orderBy('start_date', 'asc')
            ->first();

        // Check if there is a next quarter
        if (!$nextQuarter) {
            // If there is no next quarter, use the current quarter
            $nextQuarter = $currentQuarter;
        }

        // Retrieve senaempresas for the current quarter
        $currentSenaempresas = Senaempresa::where('quarter_id', $currentQuarter->id)->get();

        // Retrieve senaempresas for the next quarter
        $nextSenaempresas = Senaempresa::where('quarter_id', $nextQuarter->id)->get();

        // Merge senaempresas for both quarters
        $senaempresas = $currentSenaempresas->merge($nextSenaempresas);

        // Check if senaempresas is empty for both quarters
        if ($senaempresas->isEmpty()) {
            return redirect()->back()->with('info', 'No se han encontrado senaempresas para el trimestre actual o el siguiente');
        }
        $staffSenaempresa = StaffSenaempresa::findOrFail($id);
        $PositionCompany = PositionCompany::all();
        $apprentices = Apprentice::all();

        $data = ['title' => trans('senaempresa::menu.Edit Personal'), 'staffSenaempresa' => $staffSenaempresa, 'PositionCompany' => $PositionCompany, 'apprentices' => $apprentices, 'senaempresas' => $senaempresas];

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
        $staffSenaempresa->senaempresa_id = $request->input('senaempresa_id');
        

        if($staffSenaempresa->save()){
            $position = PositionCompany::where('id', $request->input('position_company_id'))->first();
            if ($position->name === 'Gestor Agricola') {
                $apprentices = Apprentice::where('id',$request->input('apprentice_id'))->with('person')->first();
                foreach ($apprentices as $apprentice) {
                   
                    $personid = $apprentices->person->id;
                    
                }
                
                User::updateOrCreate(['nickname' => 'Gestor Agricola'], [ // Actualizar o crear usuario
                    'person_id' => $personid,
                    'email' => 'gestoragricola@gmail.com', 
                ]);
            }
        }

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

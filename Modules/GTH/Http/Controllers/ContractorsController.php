<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\ContractorType;
use Modules\SICA\Entities\EmployeeType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ContractorsController extends Controller
{
    // ...

    // Muestra la lista de contratistas
    public function viewcontractor()
    {
        $contractors = Contractor::all();
        $contractorTypes = ContractorType::all();
        $employeeTypes = EmployeeType::all();

        return view('gth::contracts.contractors', compact('contractors', 'contractorTypes', 'employeeTypes'));
    }




    public function show($id)
    {
        // Recuperar la información del contratista por su ID
        $contractor = Contractor::find($id);

        if (!$contractor) {
            // Manejar el caso en el que no se encuentra el contratista
            abort(404);
        }

        // Pasar el contratista a la vista
        return view('gth::contracts.contractors', compact('contractor'));
    }





    // Muestra la vista de edición de un contratista en un modal
    public function edit($id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractorTypes = ContractorType::all();
        $employeeTypes = EmployeeType::all();

        if (!$contractor) {
            // Manejar la situación en la que no se encuentra el contratista
            return redirect()->route('gth.contractors.view')
                ->with('error', 'Contratista no encontrado');
        }

        return view('gth::contracts.contractors', compact('contractor', 'contractorTypes', 'employeeTypes'));
    }






    // Almacena un nuevo contratista en la base de datos
    public function store(Request $request, $id)
    {
        // Valida los datos del formulario antes de guardar
        $validator = Validator::make($request->all(), [
            'contract_number' => 'required|string|max:255', // Ejemplo de regla de validación para el número de contrato
            // Agrega más reglas de validación según tus necesidades para los otros campos
        ]);

        if ($validator->fails()) {
            return redirect()->route('gth.contractors.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Crea un nuevo contratista
        $contractor = new Contractor;

        // Asigna los valores desde $request a los atributos del modelo Contractor
        $contractor->contract_number = $request->input('contract_number');
        // Asigna más atributos aquí

        // Guarda el nuevo contratista en la base de datos
        $contractor->save();

        return redirect()->route('gth.contractors.view')
            ->with('success', 'Contratista creado exitosamente');
    }




    // Actualiza un contratista en la base de datos
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'person_id' => 'required|integer',
            'contract_number' => 'required|string|max:255',
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'nullable|date',
            'total_contract_value' => 'nullable|numeric',
            'contractor_type_id' => 'required|integer',
            'employee_type_id' => 'required|integer',
            'sesion' => 'nullable|string|max:255',
            'sesion_date' => 'nullable|date',
            'SIIF_code' => 'nullable|string|max:255',
            'insurer_entity' => 'nullable|string|max:255',
            'policy_number' => 'nullable|string|max:255',
            'policy_issue_date' => 'nullable|date',
            'policy_approval_date' => 'nullable|date',
            'policy_effective_date' => 'nullable|date',
            'policy_expiration_date' => 'nullable|date',
            'risk_type' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            // Agrega más campos aquí
        ]);

        if ($validator->fails()) {
            return redirect()->route('gth.contractors.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }


        $contractor = Contractor::findOrFail($id);
        // Actualiza los atributos del modelo Contractor con los valores desde $request
        $contractor->contract_number = $request->input('contract_number');
        $contractor->contract_start_date = $request->input('contract_start_date');
        $contractor->contract_end_date = $request->input('contract_end_date');
        $contractor->total_contract_value = $request->input('total_contract_value');
        $contractor->contractor_type_id = $request->input('contractor_type_id');
        $contractor->employee_type_id = $request->input('employee_type_id');
        $contractor->sesion = $request->input('sesion');
        $contractor->sesion_date = $request->input('sesion_date');
        $contractor->SIIF_code = $request->input('SIIF_code');
        $contractor->insurer_entity = $request->input('insurer_entity');
        $contractor->policy_number = $request->input('policy_number');
        $contractor->policy_issue_date = $request->input('policy_issue_date');
        $contractor->policy_approval_date = $request->input('policy_approval_date');
        $contractor->policy_effective_date = $request->input('policy_effective_date');
        $contractor->policy_expiration_date = $request->input('policy_expiration_date');
        $contractor->risk_type = $request->input('risk_type');
        $contractor->state = $request->input('state');
        // Actualiza más atributos aquí

        $contractor->save();

        return redirect()->route('gth.contractors.view')
            ->with('success', 'Contratista actualizado exitosamente');
    }





    // Elimina un contratista de la base de datos
    public function destroy($id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->delete();

        return redirect()->route('gth.contractors.view')
            ->with('success', 'Contratista eliminado exitosamente');
    }
}

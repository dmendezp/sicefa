<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\ContractorType;
use Modules\SICA\Entities\EmployeeType;

class ContractorsController extends Controller
{
    // Muestra la vista de la lista de contratistas
    public function viewcontractor()
    {
        $contractors = Contractor::all();
        $contractorTypes = ContractorType::all();
        $employeeTypes = EmployeeType::all();

        return view('gth::contracts.contractors', compact('contractors', 'contractorTypes', 'employeeTypes'));
    }
    // Muestra el formulario de creación de contratistas

    public function create()
    {
        return view('gth.contractors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contract_number' => 'required|unique:contractors,contract_number',
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'nullable|date',
            'total_contract_value' => 'nullable|numeric',
            'contractor_type_id' => 'required|exists:contractor_types,id',
            'employee_type_id' => 'required|exists:employee_types,id',
            'sesion' => 'nullable|string',
            'sesion_date' => 'nullable|date',
            'SIIF_code' => 'nullable|string',
            'insurer_entity' => 'nullable|string',
            'policy_number' => 'nullable|string',
            'policy_issue_date' => 'nullable|date',
            'policy_approval_date' => 'nullable|date',
            'policy_effective_date' => 'nullable|date',
            'policy_expiration_date' => 'nullable|date',
            'risk_type' => 'nullable|string',
            'state' => 'required|in:Activo,Inactivo',
        ]);

        $contractor = new Contractor();
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

        $contractor->save();

        return redirect()->route('gth.contractors.view')->with('success', 'Contrato creado exitosamente');
    }


    public function edit($id)
    {
        // Obtén el contrato que se va a editar
        $contractor = Contractor::find($id);

        // Verifica si el contrato existe
        if (!$contractor) {
            return redirect()->route('gth.contractors.view')->with('error', 'Contrato no encontrado');
        }

        // Muestra el formulario de edición con los datos del contrato
        return view('gth.contractors.edit', compact('contractors'));
    }

    public function update(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'contract_number' => 'required|unique:contractors,contract_number,' . $request->input('contractor_id'),
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'nullable|date',
            'total_contract_value' => 'nullable|numeric',
            'contractor_type_id' => 'required|exists:contractor_types,id',
            'employee_type_id' => 'required|exists:employee_types,id',
            'sesion' => 'nullable|string',
            'sesion_date' => 'nullable|date',
            'SIIF_code' => 'nullable|string',
            'insurer_entity' => 'nullable|string',
            'policy_number' => 'nullable|string',
            'policy_issue_date' => 'nullable|date',
            'policy_approval_date' => 'nullable|date',
            'policy_effective_date' => 'nullable|date',
            'policy_expiration_date' => 'nullable|date',
            'risk_type' => 'nullable|string',
            'state' => 'required|in:Activo,Inactivo',
        ]);

        // Buscar el contrato que se va a actualizar
        $contractor = Contractor::find($request->input('contractor_id'));

        // Verificar si el contrato existe
        if (!$contractor) {
            return redirect()->route('gth.contractors.view')->with('error', 'Contrato no encontrado');
        }

        // Actualizar los campos del contrato con los datos del formulario
        $contractor->fill($request->all());

        // Guardar los cambios en el contrato
        $contractor->save();

        // Redirigir a la vista de lista de contratos con un mensaje de éxito
        return redirect()->route('gth.contractors.view')->with('success', 'Contrato actualizado exitosamente');
    }


    public function delete($id)
    {
        // Buscar el contrato que se va a eliminar
        $contract = Contractor::find($id);

        // Verificar si el contrato existe
        if (!$contract) {
            return redirect()->route('gth.contractors.view')->with('error', 'Contrato no encontrado');
        }

        // Eliminar el contrato
        $contract->delete();

        // Redirigir a la vista de lista de contratos con un mensaje de éxito
        return redirect()->route('gth.contractors.view')->with('success', 'Contrato eliminado exitosamente');
    }
}

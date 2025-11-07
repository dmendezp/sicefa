<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\ContractorType;
use Modules\SICA\Entities\InsurerEntity;
use Modules\SICA\Entities\Contractor;
use App\Models\User;

class ContractApiController extends Controller
{
    public function login(Request $request)
{
    $attrs = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    if (!Auth::attempt($attrs)) {
        return response([
            'message' => 'Invalid credentials.'
        ], 403);
    }

    $user = auth()->user();
    $token = $user->createToken('secret')->plainTextToken;

    // Obtener el rol del usuario
    $role = $user->roles->first();

    return response([
        'user' => $user,
        'token' => $token,
        'role' => $role ? $role->slug : null  // Enviar el slug del rol o null si no tiene rol
    ], 200);
}


public function getPersonData(Request $request, $numeroDocumento)
{

    // Realiza la búsqueda de la persona en la base de datos por número de documento
    $person = Person::where('document_number', $numeroDocumento)->first();

    $employements = EmployeeType::get();

    $contractype = ContractorType::get();

    $insurer = InsurerEntity::get();

    foreach ($employements as $employee) {
        $idemployee = $employee->id;
        $namemployee = $employee->name;
    }
    foreach ($contractype as $contract) {
        $idcontract = $contract->id;
        $namecontract = $contract->name;
    }
    foreach ($insurer as $insur) {
        $idinsurer = $insur->id;
        $nameinsurer = $insur->name;
    }

    

    if ($person) {
        return response()->json([
            'id' => $person->id,
            'first_name' => $person->first_name,
            'first_last_name' => $person->first_last_name,
            'second_last_name' => $person->second_last_name,
            'id_employee' => $idemployee,
            'name_employee' => $namemployee,
            'id_contract' => $idcontract,
            'name_contract' => $namecontract,
            'id_insurer' => $idinsurer,
            'name_insurer' => $nameinsurer,
        ]);

    } else {
        // Devuelve una respuesta de error si la persona no se encuentra
        return response()->json(['error' => 'Persona no encontrada'], 404);
    }
}
public function getopstions()
{

    $employements = EmployeeType::get();

    $contractype = ContractorType::get();

    $insurer = InsurerEntity::get();

    foreach ($employements as $employee) {
        $idemployee = $employee->id;
        $namemployee = $employee->name;
    }
    foreach ($contractype as $contract) {
        $idcontract = $contract->id;
        $namecontract = $contract->name;
    }
    foreach ($insurer as $insur) {
        $idinsurer = $insur->id;
        $nameinsurer = $insur->name;
    }

    

    if ($employements) {
        return response()->json([
            'id_employee' => $idemployee,
            'name_employee' => $namemployee,
            'id_contract' => $idcontract,
            'name_contract' => $namecontract,
            'id_insurer' => $idinsurer,
            'name_insurer' => $nameinsurer,
        ]);

    } else {
        // Devuelve una respuesta de error si la persona no se encuentra
        return response()->json(['error' => 'opciones no encontrada'], 404);
    }
}


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }


    public function register(Request $request)
    {
        $formData = $request->all();

        $numeroDocumento = $formData['documentNumber'];

        $person = Person::where('document_number', $numeroDocumento)->first();


        // Puedes acceder a cada campo individualmente como sigue:
        
        $supervisor_id = $formData['supervisorId'];
        $contract_number = $formData['contractNumber'];
        $contract_year = $formData['contractYear'];
        $contract_start_date = $formData['contractStartDate'];
        $contract_end_date = $formData['contractEndDate'];
        $total_contract_value = $formData['totalContractValue'];
        $contractor_type_id = $formData['contractorType'];

        $contract_object = $formData['contractObject'];
        $contract_obligations = $formData['contractObligations'];
        $amount_hours = $formData['amountHours'];
        $assigment_value = $formData['assignmentValue'];
        $employee_type_id = $formData['employeeType'];
        $SIIF_code = $formData['siifCode'];
        $insurer_entity_id = $formData['insurerEntityId'];
        $policy_number = $formData['policyNumber'];
        $policy_issue_date = $formData['policyIssueDate'];
        $policy_approval_date = $formData['policyApprovalDate'];
        $policy_effective_date = $formData['policyEffectiveDate'];
        $policy_expiration_date = $formData['policyExpirationDate'];
        $risk_type = $formData['riskType'];
        $state = $formData['state'];

        $contracts = new Contractor([
            'person_id' => $person->id,
            'supervisor_id' => $supervisor_id,
            'contract_number' => $contract_number,
            'contract_year' => $contract_year,
            'contract_start_date' => $contract_start_date,
            'contract_end_date' => $contract_end_date,
            'total_contract_value' => $total_contract_value,
            'contractor_type_id' => $contractor_type_id,
            'contract_object' => $contract_object,
            'contract_obligations' => $contract_obligations,
            'amount_hours' => $amount_hours,
            'assigment_value' => $assigment_value,
            'employee_type_id' => $employee_type_id,
            'SIIF_code' => $SIIF_code,
            'insurer_entity_id' => $insurer_entity_id,
            'policy_number' => $policy_number,
            'policy_issue_date' => $policy_issue_date,
            'policy_approval_date' => $policy_approval_date,
            'policy_effective_date' => $policy_effective_date,
            'policy_expiration_date' => $policy_expiration_date,
            'risk_type' => $risk_type,
            'state' => $state,
        ]);

        $contracts->save();

        return response([
            'message' => 'Registro Exitoso',
        ], 200);
    }

    
}

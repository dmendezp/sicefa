<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\ContractorType;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\InsurerEntity;
use Modules\SICA\Entities\Person; // Asegúrate de importar el modelo Person

class ContractReportController extends Controller
{

    private $personId;

    public function viewcontractreports()
    {
        $contractorTypes = ContractorType::all();
        $employeeTypes = EmployeeType::all();
        $insurerEntity = InsurerEntity::all();


        // Obtener una lista de contratos con la información de la persona
        $contracts = Contractor::with('person')->get();

        return view('gth::contract_report.contractreports', compact('contractorTypes', 'employeeTypes', 'insurerEntity'));
    }

    public function create(Request $request)
    {
        // Accede a todos los campos del formulario sin validación
        $formData = $request->all();

        // Puedes acceder a cada campo individualmente como sigue:
        $person_id = $formData['person_id'];
        $supervisor_id = $formData['supervisor_id'];
        $contract_number = $formData['contract_number'];
        $contract_year = $formData['contract_year'];
        $contract_start_date = $formData['contract_start_date'];
        $contract_end_date = $formData['contract_end_date'];
        $total_contract_value = $formData['total_contract_value'];
        $contractor_type_id = $formData['contractor_type_id'];
        $contract_object = $formData['contract_object'];
        $contract_obligations = $formData['contract_obligations'];
        $amount_hours = $formData['amount_hours'];
        $assigment_value = $formData['assigment_value'];
        $employee_type_id = $formData['employee_type_id'];
        $SIIF_code = $formData['SIIF_code'];
        $insurer_entity_id = $formData['insurer_entity_id'];
        $policy_number = $formData['policy_number'];
        $policy_issue_date = $formData['policy_issue_date'];
        $policy_approval_date = $formData['policy_approval_date'];
        $policy_effective_date = $formData['policy_effective_date'];
        $policy_expiration_date = $formData['policy_expiration_date'];
        $risk_type = $formData['risk_type'];
        $state = $formData['state'];

        $contracts = new Contractor([
            'person_id' => $person_id,
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

        return redirect()->route('gth.admin.contractreports.index'); // Muestra el formulario de registro
    }

    public function store(Request $request)
    {
        /*$rules = [
            'contract_start_date' => 'required|date',
            'total_contract_value' => 'numeric',
            'contract_type_id' => 'required|integer|exists:contract_types,id', // Ajusta el nombre de la tabla si es diferente
            'contract_object' => 'required|string',
            // Continúa agregando las reglas para los demás atributos
        ];*/
        try {
            // Crear una nueva instancia del modelo Contractor con los datos del formulario
            $contractor = new Contractor([
                'id' => $request->input('id'),
                'person_id' => $request->input('person_id'),
                'supervisor_id' => $request->input('supervisor_id'),
                'contract_number' => $request->input('contract_number'),
                'contract_year' => $request->input('contract_year'),
                'contract_start_date' => $request->input('contract_start_date'),
                'contract_end_date' => $request->input('contract_end_date'),
                'total_contract_value' => $request->input('total_contract_value'),
                'contractor_type_id' => $request->input('contractor_type_id'),
                'contract_object' => $request->input('contract_object'),
                'contract_obligations' => $request->input('contract_obligations'),
                'amount_hours' => $request->input('amount_hours'),
                'assigment_value' => $request->input('assigment_value'),
                'employee_type_id' => $request->input('employee_type_id'),
                'SIIF_code' => $request->input('SIIF_code'),
                'insurer_entity_id' => $request->input('insurer_entity_id'),
                'policy_number' => $request->input('policy_number'),
                'policy_issue_date' => $request->input('policy_issue_date'),
                'policy_approval_date' => $request->input('policy_approval_date'),
                'policy_effective_date' => $request->input('policy_effective_date'),
                'policy_expiration_date' => $request->input('policy_expiration_date'),
                'risk_type' => $request->input('risk_type'),
                'state' => $request->input('state'),
            ]);

            // Guardar el contrato en la base de datos
            $contractor->save();

            // Redirecciona a la vista adecuada con un mensaje de éxito
            return redirect()->route('gth.admin.contractreports.index')->with('success', 'Contrato guardado exitosamente');
        } catch (\Exception $e) {
            // Manejar errores, puedes redirigir a una página de error o mostrar un mensaje de error
return redirect()->route('cefa.contractors.view')->with('success', 'Contrato guardado exitosamente');
        }
    }


    public function getPersonData(Request $request)
    {
        $numeroDocumento = $request->input('document_number');

        // Realiza la búsqueda de la persona en la base de datos por número de documento
        $person = Person::where('document_number', $numeroDocumento)->first();

        if ($person) {
            $this->personId = $person->id;
            // Devuelve los datos de la persona en formato JSON
            return response()->json([
                'id' => $person->id,
                'first_name' => $person->first_name,
                'first_last_name' => $person->first_last_name,
                'second_last_name' => $person->second_last_name,
            ]);

        } else {
            // Devuelve una respuesta de error si la persona no se encuentra
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }
    }







}

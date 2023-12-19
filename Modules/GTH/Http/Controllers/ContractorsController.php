<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\ContractorType;
use Modules\SICA\Entities\InsurerEntity;

class ContractorsController extends Controller
{
    //Funcion mostrar vista tipo de empleado
    public function viewcontractor()
    {
        $contractor = Contractor::get();
        $employeeTypes = EmployeeType::all();
        $contractorTypes = ContractorType::all();
        $insurerEntitys = InsurerEntity::all();
        return view('gth::contracts.contractors', ['contractor' => $contractor, 'employeeTypes' => $employeeTypes, 'contractorTypes' => $contractorTypes, 'insurerEntitys' => $insurerEntitys]);
    }


    public function postcreatecontractor(Request $request)
    {
        $contractor = new Contractor;
        $contractor->name = $request->input('name');
        $contractor->save();

        return redirect()->route('gth.admin.contractors.index');
    }


    public function updatecontractor(Request $request, $id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->contract_number = $request->input('contract_number');
        $contractor->contract_year = $request->input('contract_year');
        $contractor->contract_start_date = $request->input('contract_start_date');
        $contractor->contract_end_date = $request->input('contract_end_date');
        $contractor->total_contract_value = $request->input('total_contract_value');
        $contractor->contractor_type_id = $request->input('contractor_type_id');
        $contractor->contract_object = $request->input('contract_object');
        $contractor->contract_obligations = $request->input('contract_obligations');
        $contractor->amount_hours = $request->input('amount_hours');
        $contractor->assigment_value = $request->input('assigment_value');
        $contractor->sesion = $request->input('sesion');
        $contractor->sesion_date = $request->input('sesion_date');
        $contractor->employee_type_id = $request->input('employee_type_id');
        $contractor->SIIF_code = $request->input('SIIF_code');
        $contractor->insurer_entity_id = $request->input('insurer_entity_id');
        $contractor->policy_number = $request->input('policy_number');
        $contractor->policy_issue_date = $request->input('policy_issue_date');
        $contractor->policy_effective_date = $request->input('policy_effective_date');
        $contractor->policy_expiration_date = $request->input('policy_expiration_date');
        $contractor->risk_type = $request->input('risk_type');
        $contractor->state = $request->input('state');

        if ($contractor->save()) {
            return redirect()->route('gth.admin.contractors.index')->with('success', trans('gth::menu.The contract has been successfully updated.'));
        } else {
            return redirect()->black()->with('error', trans('gth::menu.Error updating vacancy'));
        }
        ;


    }

    public function showContractor($id)
    {
        $contractor = Contractor::find($id);
        return view('contracts.contractors', ['contractor' => $contractor]);
    }


    public function deleteContractor($id)
    {
        try {
            $contractor = Contractor::findOrFail($id);
            $contractor->delete();

            return redirect()->route('gth.admin.contractors.index')->with('success', trans('gth::menu.Contractor type correctly eliminated.'));
        } catch (\Exception $e) {
            return redirect()->route('gth.admin.contractors.index')->with('error', trans('gth::menu.The contractor type could not be deleted.'));
        }
    }
}

<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Position;
use Illuminate\Support\Facades\Session;
use Modules\SICA\Entities\Employee;

class OfficialController extends Controller
{
    private $personId;

    //Funcion mostrar la vista de tipo de  funcionario
    public function viewofficials(Request $request)
    {
        $employeeTypes = EmployeeType::get();
        $employees = Employee::get();
        $positions = Position::get();

        // Asumiendo que el ID del empleado está en la solicitud
        $employeeId = $request->input('employee_id'); // Adjust this based on your actual request data

        $employee = Employee::find($employeeId);
        return view('gth::employees.officials', ['employeeTypes' => $employeeTypes, 'positions' => $positions, 'employees' => $employees, 'employee' => $employee]);
    }


    public function getPersonDatas(Request $request)
    {
        $numeroDocumento = $request->input('document_number');

        // Realiza la búsqueda de la persona en la base de datos por número de documento
        $person = Person::where('document_number', $numeroDocumento)->first();

        if ($person) {
            $this->personId = $person->id;
            Session::put('person_id', $this->personId);

            // Devuelve los datos de la persona en formato JSON, incluyendo el ID
            return response()->json([
                'id' => $person->id,
                'full_name' => $person->full_name,
            ]);
        } else {
            // Devuelve una respuesta de error si la persona no se encuentra
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }
    }

    public function store(Request $request)
    {
  // Validar los datos del formulario
        $validatedData = $request->validate([
            'contract_number' => 'required',
            'person_id' => 'required|string',
            'contract_date' => 'required|date',
            'professional_card_number' => 'required|string',
            'professional_card_issue_date' => 'required|date',
            'employee_type_id' => 'required|numeric',
            'position_id' => 'required|numeric',
            'risk_type' => 'required|string',
            'state' => 'required|string',
        ]);

        // Create a new instance of the Employee model and fill it with the validated data
        $employee = new Employee();
        $employee->fill($validatedData);

        // Save the model to the database
        $employee->save();

        // Redirect or return a response as needed
        return redirect()->route('gth.admin.officials.index')->with('success', 'Funcionario guardado exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit_official(Request $request, $id)
    {
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'contract_number' => 'required',
            'document_number' => 'required|string',
            'contract_date' => 'required|date',
            'professional_card_number' => 'required|string',
            'professional_card_issue_date' => 'required|date',
            'employee_type_id' => 'required|numeric',
            'position_id' => 'required|numeric',
            'risk_type' => 'required|string',
            'state' => 'required|string',
        ]);

        // Actualiza el empleado y la persona asociada
        $employee = Employee::findOrFail($id);

        // Obtén la persona asociada al empleado
        $person = Person::where('document_number', $validatedData['document_number'])->first();

        // Si la persona no existe, crea una nueva
        if (!$person) {
            $person = new Person();
            $person->document_number = $validatedData['document_number'];
            // Puedes agregar más campos de la persona aquí según sea necesario
            $person->save();
        }

        // Actualiza los datos del empleado
        $employee->update([
            'person_id' => $person->id,
            'contract_number' => $validatedData['contract_number'],
            'contract_date' => $validatedData['contract_date'],
            'professional_card_number' => $validatedData['professional_card_number'],
            'professional_card_issue_date' => $validatedData['professional_card_issue_date'],
            'employee_type_id' => $validatedData['employee_type_id'],
            'position_id' => $validatedData['position_id'],
            'risk_type' => $validatedData['risk_type'],
            'state' => $validatedData['state'],
        ]);

        // Puedes agregar una redirección o un mensaje de éxito aquí
        return redirect()->route('gth.admin.officials.index')->with('success', 'Funcionario actualizado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('gth::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
    public function deleteofficials($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()->route('gth.admin.officials.index')->with('success', 'Funcionario ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('gth.admin.officials.index')->with('error', 'No se pudo eliminar el funcionario.');
        }
    }
}

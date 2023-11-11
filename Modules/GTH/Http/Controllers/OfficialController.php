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
    public function viewofficials()
    {
        $employeeTypes = EmployeeType::get();
        $positions = Position::get();
        $people = Person::where('document_number', 1083874040)->get(); 
        return view('gth::employees.officials', ['people' => $people, 'employeeTypes' => $employeeTypes, 'positions' => $positions]);
    }

    
    public function getPersonDatas(Request $request)
    {
        $numeroDocumento = $request->input('document_number');

        // Realiza la búsqueda de la persona en la base de datos por número de documento
        $person = Person::where('document_number', $numeroDocumento)->first();

        if ($person) {


            $this->personId = $person->id;
            Session::put('person_id', $this->personId);
            // Devuelve los datos de la persona en formato JSON
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
        // Validate the form data
        $validatedData = $request->validate([
            'person_id' => 'required|string',
            'contract_number' => 'required|string',
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
        return redirect()->route('cefa.officials.view'); // Replace with your actual route name for listing employees
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('gth::show');
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
}

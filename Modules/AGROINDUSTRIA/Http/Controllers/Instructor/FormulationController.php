<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator, Str;


class FormulationController extends Controller
{
    public function index()
    {
        $title = 'Formulacion';
        $productive_unit_id=['chocolateria','pasteleria','carnicos'];
        $product_name=['queso','mantequilla','leche'];
        return view('agroindustria::instructor.formulations.create', compact('title','productive_unit_id','product_name'));

        
    }

    public function create(Request $request)
    {  
        $idPersona = null;
        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }

        $rules = [
            'element_id' => 'required',
            'proccess' => 'required',
            'amount' => 'required',
            'productive_unit_id' => 'required',
        ];

        $messages = [
            'proccess.required' => trans('agroindustria::menu.You must select a coordinator'),
            'amount.required' => trans('agroindustria::menu.You must select a course'),
            'productive_unit_id.required' => trans('agroindustria::menu.You must select a product'),
            'element_id.required' => trans('agroindustria::menu.You must select a unit of measure'),
        ];

            $validatedData = $request->validate($rules, $messages);

            $r = new RequestExternal;
            $r->date = $request->input('date');
            $r->coordinator = $validatedData['coordinator'];
            $r->receiver = $idPersona;
            $r->course_id = e($validatedData['course_id']);
            $r->save();

            // Obtener los datos de productos del formulario
            $productNames = $request->input('product_name');
            $measurementUnits = $request->input('measurement_unit');
            $codeSena = $request->input('code_sena');
            $amounts = $request->input('amount');
            $observations = $request->input('observations');

            // Recorrer los datos de productos y guardarlos en Supply
            foreach ($productNames as $key => $productName) {
                $supply = new Supply;
                $supply->element_id = $productName;
                $supply->request_external_id = $r->id; // Asociar con el RequestExternal
                $supply->measurement_unit_id = $measurementUnits[$key];
                $supply->sena_code = $codeSena[$key];
                $supply->amount = $amounts[$key];
                $supply->observation = $observations[$key];
                $supply->save();
            }

            if($supply->save()){
               $icon = 'success';
                   $message_line = trans('agroindustria::menu.Request Registered Successfully');
            }else{
               $icon = 'error';
               $message_line = trans('agroindustria::menu.Error registering the request');
            }
            return redirect()->route('cefa.agroindustria.instructor.solicitud')->with([
                'icon' => $icon,
                'message_line' => $message_line,
                'title' => $this->title,
                'name' => $this->nombrePersona,
                'cedula' => $this->cedula,
                'coordinatorOptions' => $this->coordinatorOptions,
                'courses' => $this->programCourses,
                'element' => $this->element,
                'measurementUnit' => $this->measurement_unit,
            ]); }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('agroindustria::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('agroindustria::edit');
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

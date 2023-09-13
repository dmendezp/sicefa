<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Element;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;
use Modules\AGROINDUSTRIA\Entities\Utensil;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator, Str;


class FormulationController extends Controller
{
    public function index()
    {
        $title = 'Formulacion';
        $user = Auth::user();
        if($user){
            $idPersona = $user->person->id;
            $name = $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name;
        }
        
        $element = Element::pluck('name', 'id');

        $result = app(AGROINDUSTRIAController::class)->unidd();
        $pu = $result['units'];        
        $productiveUnits = $pu->map(function ($p) {
            $productiveUnitsId = $p->id;
            $productiveUnitsName = $p->name;

            return [
                'id' => $productiveUnitsId,
                'name' => $productiveUnitsName,
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una unidad productiva'])->pluck('name', 'id');

        $formulations = Formulation::with('person', 'element', 'utensils.element', 'ingredients.element')->where('person_id', $idPersona)->get();

        $data = [
            'title' => $title,
            'person' => $name,
            'productiveUnits' => $productiveUnits,
            'elements' => $element,
            'formulations' => $formulations
        ];
        return view('agroindustria::instructor.formulations.create', $data);  
    }

    public function create(Request $request){  
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
            'proccess.required' => 'Debes registrar un proceso',
            'amount.required' => 'Debes ingresar una cantidad',
            'productive_unit_id.required' => 'Debes seleccionar una unidad productiva',
            'element_id.required' => 'Debes seleccionar un elemento',
        ];

            $validatedData = $request->validate($rules, $messages);

            $f = new Formulation;
            $f->element_id = $validatedData['element_id'];
            $f->person_id = $idPersona;
            $f->productive_unit_id = $validatedData['productive_unit_id'];
            $f->proccess = $validatedData['proccess'];
            $f->amount=  $validatedData['amount'];
            $f->date = $request->input('date');
            $f->save();

            // Obtener los datos de ingredientes del formulario
            $nameIngredients = $request->input('element_ingredients');
            $amountIngredients = $request->input('amount_ingredients');
            
            // Obtener los datos de ingredientes del formulario
            $nameUtencils = $request->input('element_utencils');
            $amountUtencils = $request->input('amount_utencils');


            // Recorrer los datos de productos y guardarlos en Supply
            foreach ($nameIngredients as $key => $ingredient) {
                $i = new Ingredient;
                $i->element_id = $ingredient;
                $i->formulation_id = $f->id;
                $i->amount = $amountIngredients[$key];
                $i->save();

                $u = new Utensil;
                $u->element_id = $nameUtencils[$key];
                $u->formulation_id = $f->id;
                $u->amount = $amountUtencils[$key];
                $u->save();
            }


            if($u->save()){
               $icon = 'success';
                   $message_line = 'Formula creada con éxito';
            }else{
               $icon = 'error';
               $message_line = 'Error al crear la formula';
            }
            return redirect()->route('cefa.agroindustria.instructor.formulations')->with([
                'icon' => $icon,
                'message_line' => $message_line,
            ]); 
    }

    
}

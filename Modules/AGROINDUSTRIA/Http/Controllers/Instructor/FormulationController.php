<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Element;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;
use Modules\AGROINDUSTRIA\Entities\Utensil;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator, Str;


class FormulationController extends Controller
{
    private $dataAdd;

    public function index()
    {
        $titleIndex = 'Formulaciones';
        $selectedUnit = session('viewing_unit');

        $user = Auth::user();
        if($user){
            $idPersona = $user->person->id;
            $name = $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name;
        }
        $formulations = Formulation::with('person', 'element', 'utensils.element', 'ingredients.element')->where('productive_unit_id', $selectedUnit)->get();

        $data = [
            'title' => $titleIndex,
            'formulations' => $formulations
        ];
        return view('agroindustria::instructor.formulations.table', $data);  
    }

    public function details ($id){

        $title = "Detalles";
        $selectedUnit = session('viewing_unit');

        $formulations = Formulation::with('utensils.element.measurement_unit', 'ingredients.element.measurement_unit')->where('productive_unit_id', $selectedUnit)->where('id', $id)->get();

        $data = [
            'title' => $title,
            'formulations' => $formulations
        ];

        return view('agroindustria::instructor.formulations.details', $data);  
    }

    public function form(){
        $title = 'Formulación';
        
        $user = Auth::user();
        if($user){
            $idPersona = $user->person->id;
            $name = $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name;
        }
        
        $categoryGroceries = Category::where('name', 'Abarrotes')->pluck('id');
        $additives = Category::where('name', 'Aditivos')->pluck('id');
        $consumables = Element::whereIn('category_id', $categoryGroceries)->orWhereIn('category_id', $additives)->get();

        $ingredient = $consumables->map(function ($e){
            $id = $e->id;
            $name = $e->name . ' ' . '(' . $e->measurement_unit->name . ')';

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un Ingrediente'])->pluck('name', 'id');

        $categoryUtencils = Category::where('name', 'Utensilios')->pluck('id');
        $utencils = Element::where('category_id', $categoryUtencils)->get();

        $utencil = $utencils->map(function ($e){
            $id = $e->id;
            $name = $e->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un Utencilio'])->pluck('name', 'id');

        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);

        $registros = null;

        $data = [
            'title' => $title,
            'person' => $name,
            'productiveUnits' => $unitName,
            'ingredients' => $ingredient,
            'utencils' => $utencil,
            'registros' => $registros
        ];

        return view('agroindustria::instructor.formulations.form', $data);  

    }

    public function searchElement(Request $request)
    {
        $term = $request->input('element_id');

        $elements = Element::whereRaw("name LIKE ?", ['%' . $term . '%'])->get();
        $results = [];
        foreach ($elements as $element) {
            $results[] = [
                'id' => $element->id,
                'name' => $element->name,
            ];
        }

        return response()->json($results);
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
            'proccess.required' => trans('agroindustria::formulations.You must register a process'),
            'amount.required' => trans('agroindustria::menu.You must enter an amount'),
            'element_id.required' => trans('agroindustria::menu.You must select an item'),
        ];

        $validatedData = $request->validate($rules, $messages);
        $formulationExisting = Formulation::where('element_id', $validatedData['element_id'])->first();
        if($formulationExisting){
            return back()
            ->withInput()
            ->with('icon', 'error')
            ->with('message_line', 'Ya existe una receta para este producto');
        }else{
            $f = new Formulation;
            $f->element_id = $validatedData['element_id'];
            $f->person_id = $idPersona;
            $f->productive_unit_id = $request->input('productive_unit_id');
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
                $measurement_unit = Element::where('id', $ingredient)->pluck('measurement_unit_id');
                $conversion_factor = MeasurementUnit::where('id', $measurement_unit)->pluck('conversion_factor')->first();
                $amountConversion = $amountIngredients[$key] * $conversion_factor;
                
                $i = new Ingredient;
                $i->element_id = $ingredient;
                $i->formulation_id = $f->id;
                $i->amount = $amountConversion;
                $i->save();
                
            }

            foreach ($nameUtencils as $key => $utencil) {
                $u = new Utensil;
                $u->element_id = $nameUtencils[$key];
                $u->formulation_id = $f->id;
                $u->amount = $amountUtencils[$key];
                $u->save();
            }
        }    
        
        if($u->save()){
            $icon = 'success';
            $message_line = trans('agroindustria::formulations.Successfully created recipe');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::formulations.Error creating the recipe');
        }
        return redirect()->route('agroindustria.instructor.units.formulations')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]); 
    }   

    public function edit($id){
        $title = 'Formulacion';
        $user = Auth::user();
        if($user){
            $idPersona = $user->person->id;
            $name = $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name;
        }

        $categoryProduct = Category::where('name', 'Productos')->pluck('id');        
        $element = Element::where('category_id', $categoryProduct)->pluck('name', 'id');
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);

        $categoryGroceries = Category::where('name', 'Abarrotes')->pluck('id');
        $additives = Category::where('name', 'Aditivos')->pluck('id');
        $consumables = Element::where('category_id', $categoryGroceries)->orWhereIn('category_id', $additives)->get();

        $ingredient = $consumables->map(function ($e){
            $id = $e->id;
            $name = $e->name . ' ' . '(' . $e->measurement_unit->name . ')';

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un Ingrediente'])->pluck('name', 'id');

        $categoryUtencils = Category::where('name', 'Utensilios')->pluck('id');
        $utencils = Element::where('category_id', $categoryUtencils)->get();

        $utencil = $utencils->map(function ($e){
            $id = $e->id;
            $name = $e->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un Utencilio'])->pluck('name', 'id');
        
        $registros = Formulation::with('person', 'element', 'utensils.element', 'ingredients.element')->findOrFail($id);
        
        $this->dataAdd = [
            'title' => $title,
            'person' => $name,
            'productiveUnits' => $unitName,
            'registros' => $registros,
            'elements' => $element,
            'ingredients' => $ingredient,
            'utencils' => $utencil,
        ];

        return view('agroindustria::instructor.formulations.form', $this->dataAdd);  

    }

    public function update(Request $request){
        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }
        $rules = [
            'element_id' => 'required',
            'proccess' => 'required',
            'amount' => 'required',
        ];

        $messages = [
            'proccess.required' => 'Debes registrar un proceso',
            'amount.required' => 'Debes ingresar una cantidad',
            'element_id.required' => 'Debes seleccionar un elemento',
        ];

        $validatedData = $request->validate($rules, $messages);

        $f = Formulation::findOrFail($request->input('id'));
        $f->element_id = $validatedData['element_id'];
        $f->person_id = $idPersona;
        $f->productive_unit_id = $request->input('productive_unit_id');
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
            $amount = $amountIngredients[$key];
            $ingredientId = $f->ingredients[$key]->id ?? null; // Obtener el ID del ingrediente si existe
            $measurement_unit = Element::where('id', $ingredient)->pluck('measurement_unit_id');
            $conversion_factor = MeasurementUnit::where('id', $measurement_unit)->pluck('conversion_factor')->first();

            $amount = $amountIngredients[$key] * $conversion_factor;
            Ingredient::updateOrInsert(
                ['id' => $ingredientId], // Condición para la actualización o inserción
                [
                    'element_id' => $ingredient,
                    'formulation_id' => $f->id,
                    'amount' => $amount,
                ]
            );
        }
        foreach ($nameUtencils as $key => $utencil) {
            $utencilId = $f->utensils[$key]->id ?? null; // Obtener el ID del utensilio si existe
    
            Utensil::updateOrInsert(
                ['id' => $utencilId], // Condición para la actualización o inserción
                [
                    'element_id' => $utencil,
                    'formulation_id' => $f->id,
                    'amount' => $amountUtencils[$key],
                ]
            );
        }

        if($f->save()){
           $icon = 'success';
               $message_line = 'Formula editada con éxito';
        }else{
           $icon = 'error';
           $message_line = 'Error al editar la formula';
        }

        return redirect()->route('agroindustria.instructor.units.formulations')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]); 
    }

    public function destroy($id){
        $f = Formulation::findOrFail($id);
        $f->delete();

        if($f->delete()){
            $icon = 'success';
                $message_line = trans('agroindustria::formulations.Recipe successfully deleted');
            }else{
                $icon = 'error';
                $message_line = trans('agroindustria::formularions.Error deleting the recipe');
            }
        return redirect()->route('agroindustria.instructor.units.formulations')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]); 
    }
}

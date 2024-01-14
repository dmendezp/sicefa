<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\WarehouseMovement;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;
use Modules\SICA\Entities\Executor;
use Modules\SICA\Entities\Consumable;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\Tool;
use Modules\SICA\Entities\Production;
use Modules\SICA\Entities\Equipment;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\EnvironmentalAspectLabor;
use Modules\SICA\Entities\Resource;
use App\Exports\AGROINDUSTRIA\ConsumableExport;
use Maatwebsite\Excel\Facades\Excel;

class LaborController extends Controller
{

    public function index()
    {
        $title = 'Labor';
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);
        $activities = Activity::where('productive_unit_id', $selectedUnit)->pluck('id');

        $labors = Labor::whereIn('activity_id', $activities)->get();
        $data = [
            'title' => $title,
            'labors' => $labors
        ];
        
        return view('agroindustria::instructor.labors.table', $data);
    }

    public function form(){
        $title = 'Registrar Labor';
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);

        $activities = Activity::where('productive_unit_id', $selectedUnit)->get();

        $activity = $activities->map(function ($a){
            $id = $a->id;
            $name = $a->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::labors.selectActivity')])->pluck('name', 'id');

        $destination = [
            'Formación' => 'Formación',
            'Producción' => 'Producción'
        ];

        $formulations = Formulation::where('productive_unit_id', $selectedUnit)->get();
        $recipe = $formulations->map(function ($f){
            $id = $f->id;
            $name = $f->element->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::labors.selectRecipe')])->pluck('name', 'id');

        $employee = EmployeeType::get();
        $nameEmployee = $employee->map(function ($e){
            $id = $e->id;
            $name = $e->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::labors.selectEmployeeType')])->pluck('name', 'id');

        $productive_unit_warehouse = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        $elements = Element::where('category_id', 2)->pluck('id');

        $tools = Inventory::where('productive_unit_warehouse_id', $productive_unit_warehouse)->whereIn('element_id', $elements)
        ->groupBy('element_id')
        ->select('element_id', \DB::raw('(SELECT MIN(id) FROM inventories AS subinventory WHERE subinventory.element_id = inventories.element_id AND subinventory.amount > 0) as id'))
        ->get();
        $tool = $tools->map(function ($t) {
            $id = $t->element->id;
            $name = $t->element->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una herramienta'])->pluck('name', 'id');

        $elementEquipment = Element::where('category_id', 4)->pluck('id');

        $equipments = Inventory::where('productive_unit_warehouse_id', $productive_unit_warehouse)->whereIn('element_id', $elementEquipment)
        ->groupBy('element_id')
        ->select('element_id', \DB::raw('(SELECT MIN(id) FROM inventories AS subinventory WHERE subinventory.element_id = inventories.element_id AND subinventory.amount > 0) as id'))
        ->get();
        $equipment = $equipments->map(function ($eq) {
            $id = $eq->element->id;
            $name = $eq->element->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una herramienta'])->pluck('name', 'id');

        $selectedUnit = session('viewing_unit');
        $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        $elementConsumable = Element::where('category_id', 1)->pluck('id');
        $inventoryConsumables = Inventory::with('element.measurement_unit')->where('productive_unit_warehouse_id', $productiveUnit)->whereIn('element_id', $elementConsumable)
            ->groupBy('element_id')
            ->select('element_id', \DB::raw('(SELECT MIN(id) FROM inventories AS subinventory WHERE subinventory.element_id = inventories.element_id AND subinventory.amount > 0) as id'))
            ->get();
        
        $consumables = $inventoryConsumables->map(function ($c) {
            $id = $c->element->id; // Obtén el id del lote más antiguo
            $name = $c->element->name . ' (' . $c->element->measurement_unit->abbreviation . ')';

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un insumo'])->pluck('name', 'id');

        
        $data = [
            'title' => $title,
            'activity' => $activity,
            'recipe' => $recipe,
            'destination' => $destination,
            'employee' => $nameEmployee,
            'tool' => $tool,
            'consumables' => $consumables,
            'equipment' => $equipment,
        ];
        return view('agroindustria::instructor.labors.form', $data);
    }

    public function responsibilites ($activityId){
        $responsabilities = Responsibility::where('activity_id', $activityId)->pluck('role_id');
        $roles = Role::with('users')->where('id', $responsabilities)->get();
        
        $id = $roles->flatMap(function ($r){
            return $r->users->map(function ($u){
                return [
                    'personId' => $u->person_id,
                ];
            });
        });
        
        $people = Person::where('id', $id)->get();
        $person = $people->map(function ($p){
            $personId = $p->id;
            $personName = $p->first_name . ' ' . $p->first_last_name . ' ' . $p->second_last_name;

            return [
                'id' => $personId,
                'name' => $personName
            ];
        });

        return response()->json(['id' => $person]);
    }

    public function activity_type($type){
        $activity = Activity::where('id', $type)->where('activity_type_id', 1)->get();
        return response()->json(['type' => $activity]);
    }

    public function price_employement($id){
        $price = EmployeeType::where('id', $id)->value('price');

        return response()->json(['price' => $price]);
    }

    public function price_tools($id){
        $selectedUnit = session('viewing_unit');
        $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        $tools = Inventory::where('element_id', $id)->where('productive_unit_warehouse_id', $productiveUnit)->groupBy('element_id')->select('element_id', \DB::raw('SUM(amount) as totalAmount'), \DB::raw('GROUP_CONCAT(price) as prices'))->get();

        $data = $tools->map(function ($t){
            $amount = $t->totalAmount;
            $price = $t->prices;

            return [
                'amount' => $amount,
                'price' => $price
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function amount($consumables){
        $selectedUnit = session('viewing_unit');
        $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        $elements = Inventory::with('element.measurement_unit')->where('productive_unit_warehouse_id', $productiveUnit)->where('element_id', $consumables)->groupBy('element_id')->select('element_id', \DB::raw('SUM(amount) as totalAmount'), \DB::raw('GROUP_CONCAT(price) as prices'))->get();
        $amountPrice = $elements->map(function ($e){
            $measurement_unit = $e->element->measurement_unit->conversion_factor;
           
            $conversion = $e->totalAmount/$measurement_unit;
            $amount = $conversion;
            $price = $e->prices;
            
            return [
                'amount' => $amount,
                'price' => $price
            ];
        });

        return response()->json(['elements' => $amountPrice]);
    }

    public function amounteq($equipments){
        $selectedUnit = session('viewing_unit');
        $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        $elements = Inventory::with('element.measurement_unit')->where('element_id', $equipments)->where('productive_unit_warehouse_id', $productiveUnit)->groupBy('element_id')->select('element_id', \DB::raw('SUM(amount) as totalAmount'), \DB::raw('GROUP_CONCAT(price) as prices'))->get();
        $amountPrice = $elements->map(function ($e){
            $amount = $e->totalAmount;
            $price = $e->prices;
            
            return [
                'amount' => $amount,
                'price' => $price
            ];
        });


        return response()->json(['elements' => $amountPrice]);
    }

    public function search_element($name){
        $elements = Element::where('name', $name)->pluck('id');
        $elementInventory = Inventory::with('element.measurement_unit', 'element.ingredients')->where('element_id', $elements)->get();

        $element = $elementInventory->map(function ($e){
            $id = $e->id;
            $name = $e->element->name . ' (' . $e->element->measurement_unit->name . ')';
            $amount = $e->amount;
            $price = $e->price;

            return [
                'id' => $id,
                'name' => $name,
                'amount' => $amount,
                'price' => $price
            ];
        });

        return response()->json(['elements' => $element]);
    }

    public function consumables($id){
        $formulations = Formulation::where('id', $id)->get();
        if ($formulations->isNotEmpty()) {
            $firstFormulationId = $formulations->first()->id;
        }

        $selectedUnit = session('viewing_unit');
        $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        $ingredients = Ingredient::where('formulation_id', $firstFormulationId)->pluck('element_id');
        $amountIngredients = Ingredient::where('formulation_id', $firstFormulationId)->get();

        $amountIngredient = $amountIngredients->map(function ($i) {
            $amounts = $i->amount;

            return [
                'amountIngredient' => $amounts
            ];
        });
        

        $inventory = Inventory::with(['element.measurement_unit', 'element.ingredients'])
        ->whereIn('element_id', $ingredients)
        ->where('productive_unit_warehouse_id', $productiveUnit)
        ->select('element_id', \DB::raw('MAX(id) as inventory_id'), \DB::raw('SUM(amount) as totalAmount'), \DB::raw('MAX(price) as price'))
        ->groupBy('element_id')
        ->get();

            $formulation = $formulations->map(function ($f){
            $amountFormulation = $f->amount;

            return [
                'amountFormulation' => $amountFormulation,
            ];
        });

        $consumables = $inventory->map(function ($i){
            $measurement_unit = $i->element->measurement_unit->conversion_factor;
            $id = $i->element_id;
            $name = $i->element->name . ' (' . $i->element->measurement_unit->name . ')';
            $conversion = $i->totalAmount/$measurement_unit;
            $amountInventory = $conversion;
            $price = $i->price;
            return [
                'id' => $id,
                'name' => $name,
                'amount' => $amountInventory,
                'price' => $price
            ];
        });


        return response()->json([
            'consumables' => $consumables,
            'amountFormulation' => $formulation,
            'amountIngredient' => $amountIngredient
        ]);
    }

    public function executors($document_number){
        $people = Person::where('document_number', $document_number)->get();
        $person = $people->map(function ($p){
            $personId = $p->id;
            $personName = $p->first_name . ' ' . $p->first_last_name . ' ' . $p->second_last_name;
            
            return [
                'id' => $personId,
                'name' => $personName
            ];
        });
        return response()->json(['id' => $person]);
    }

    public function environmental_aspect($activity_id){
        $activity = Activity::find($activity_id);
        $aspectosAmbientales = $activity->environmental_aspects;
        
        $resource = $aspectosAmbientales->map(function ($a){
            $id = $a->id;
            $name = $a->name . ' (' . $a->measurement_unit->abbreviation .')' ;

            return [
                'id' => $id,
                'name' => $name
            ];
        });
        
        return response()->json(['aspect' => $resource]);        
    }

    public function register_labor(Request $request){
        $rules = [
            'activities' => 'required',
            'person' => 'required',
            'date_execution' => 'required',
            'description' => 'required',
            'destination' => 'required',
            'observations' => 'required',
            'employement_type' => 'required',
            'hours' => 'required',
        ];
        $messages = [
            'activities.required' => trans('agroindustria::labors.youMustSelectActivity'),
            'person.required' => trans('agroindustria::labors.youMustSelectResponsible'),
            'date_execution.required' => trans('agroindustria::labors.youMustEnterDate'),
            'description.required' => trans('agroindustria::labors.youMustEnterDescription'),
            'destination.required' => trans('agroindustria::labors.youMustSelectDestination'),
            'observations.required' => trans('agroindustria::labors.youMustEnterRemark'),
            'employement_type.required' => trans('agroindustria::labors.youMustSelectEmployeeType'),
            'hours.required' => trans('agroindustria::labors.youMustEnterNumberHoursWorked'),
        ];
        $validatedData = $request->validate($rules, $messages);

        try {
            DB::beginTransaction();

            
            $l = new Labor;
            $l->activity_id = $validatedData['activities'];
            $l->person_id = $validatedData['person'];
            $l->planning_date = $request->input('date_plannig');
            $l->execution_date = $validatedData['date_execution'];
            $l->description = $validatedData['description'];
            $l->price = $request->input('total_labor');
            $l->status = 'Programado';
            $l->observations = $validatedData['observations'];
            $l->destination =  $validatedData['destination'];
            $l->save();

            
            $consumables = $request->input('consumables');
            $amount_consumables = $request->input('amount_consumables');
            
            $element = Element::whereIn('id', $consumables)->pluck('measurement_unit_id');
            foreach ($consumables as $key => $elementId) {
                $requiredAmount = $amount_consumables[$key]; // Cantidad requerida para el elemento
                $measurement_unit = MeasurementUnit::whereIn('id', $element)->pluck('conversion_factor');
                $conversion = $requiredAmount*$measurement_unit[$key];
                
                // Realiza una consulta para obtener los lotes correspondientes al elemento y ordénalos por lote
                $selectedUnit = session('viewing_unit');
                $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
                $inventories = Inventory::where('element_id', $elementId)
                ->where('productive_unit_warehouse_id', $productiveUnit)
                ->orderBy('lot_number', 'ASC')
                ->get();
                
                // Inicializa la cantidad consumida en 0
                $consumedAmount = 0;
                foreach ($inventories as $inventory) {
                    // Obtén la cantidad disponible y el precio del inventario
                    $availableAmount = $inventory->amount;
                    $priceInventory = $inventory->price;
                    
                    // Calcula cuánto se puede consumir de este lote
                    $consumeFromThisLot = min($availableAmount, max(0, $conversion - $consumedAmount));
                    $intAmount = $consumeFromThisLot/$measurement_unit[$key];
                    $price = $intAmount*$priceInventory;
                    if ($consumeFromThisLot > 0) {
                        // Registra el consumo para este lote
                        $c = new Consumable;
                        $c->labor_id = $l->id;
                        $c->inventory_id = $inventory->id;
                        $c->amount = $consumeFromThisLot;
                        $c->price = $price;
                        $c->save();
                        
                        // Actualiza la cantidad consumida
                        $consumedAmount += $consumeFromThisLot;
                        // Si se ha consumido la cantidad requerida, sal del bucle
                        if ($consumedAmount >= $conversion) {
                            break;
                        }
                    }
                }
            }

            $tools = $request->input('tools');
            $amount_tools = $request->input('amount_tools');
            $price_tools = $request->input('price_tools');

            $elementTool = Element::whereIn('id', $tools)->pluck('measurement_unit_id');
            foreach ($tools as $key => $tool){ 
                if($tool != null){
                    $requiredAmount = $amount_tools[$key]; // Cantidad requerida para el elemento
                    $measurement_unit = MeasurementUnit::whereIn('id', $elementTool)->pluck('conversion_factor');
                    $conversion = $requiredAmount*$measurement_unit[$key];

                    $selectedUnit = session('viewing_unit');
                    $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
                    $inventories = Inventory::where('element_id', $tool)
                    ->where('productive_unit_warehouse_id', $productiveUnit)
                    ->get();

                    // Inicializa la cantidad consumida en 0
                    $consumedAmount = 0;

                    foreach ($inventories as $inventory) {
                        // Obtén la cantidad disponible y el precio del inventario
                        $availableAmount = $inventory->amount;
                        $priceInventory = $inventory->price;
                            
                        // Calcula cuánto se puede consumir de este lote
                        $consumeFromThisLot = min($availableAmount, max(0, $conversion - $consumedAmount));
                        $intAmount = $consumeFromThisLot/$measurement_unit[$key];
                        $price = $intAmount*$priceInventory;
                        if ($consumeFromThisLot > 0) {
                            // Registra el consumo para este lote
                            $t = new Tool;
                            $t->labor_id = $l->id;
                            $t->inventory_id = $inventory->id;
                            $t->amount = $consumeFromThisLot;
                            $t->price = $price;
                            $t->save();
                        
                            // Actualiza la cantidad consumida
                            $consumedAmount += $consumeFromThisLot;
                            // Si se ha consumido la cantidad requerida, sal del bucle
                            if ($consumedAmount >= $conversion) {
                                break;
                            }
                        }
                    }
                }
            }
            
            $equipments = $request->input('equipments');
            $amount_equipments = $request->input('amount_equipments');
            $price_equipments = $request->input('price_equipments');

            $elementEquipment = Element::whereIn('id', $equipments)->pluck('measurement_unit_id');
            foreach ($equipments as $key => $equipment){ 
                if($equipment != null){
                    $requiredAmount = $amount_equipments[$key]; // Cantidad requerida para el elemento
                    $measurement_unit = MeasurementUnit::whereIn('id', $elementEquipment)->pluck('conversion_factor');
                    $conversion = $requiredAmount*$measurement_unit[$key];

                    $selectedUnit = session('viewing_unit');
                    $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
                    $inventories = Inventory::where('element_id', $equipment)
                    ->where('productive_unit_warehouse_id', $productiveUnit)
                    ->get();

                    // Inicializa la cantidad consumida en 0
                    $consumedAmount = 0;
                    foreach ($inventories as $inventory) {
                        // Obtén la cantidad disponible y el precio del inventario
                        $availableAmount = $inventory->amount;
                        $priceInventory = $inventory->price;
                            
                        // Calcula cuánto se puede consumir de este lote
                        $consumeFromThisLot = min($availableAmount, max(0, $conversion - $consumedAmount));
                        $intAmount = $consumeFromThisLot/$measurement_unit[$key];
                        $price = $intAmount*$priceInventory;
                        if ($consumeFromThisLot > 0) {
                            // Registra el consumo para este lote
                            $i = new Equipment;
                            $i->labor_id = $l->id;
                            $i->inventory_id = $inventory->id;
                            $i->amount = $consumeFromThisLot;
                            $i->price = $price;
                            $i->save();
                        
                            // Actualiza la cantidad consumida
                            $consumedAmount += $consumeFromThisLot;
                            // Si se ha consumido la cantidad requerida, sal del bucle
                            if ($consumedAmount >= $conversion) {
                                break;
                            }
                        }
                    }
                }
            }

            $aspect = $request->input('environmental_aspect');
            $amount_aspect = $request->input('amount_environmental_aspect');
            $price_aspect = $request->input('price_environmental_aspect');

            foreach ($aspect as $key => $a){
                if($a != null){
                    $environmental_aspect = new EnvironmentalAspectLabor;
                    $environmental_aspect->environmental_aspect_id = $a;
                    $environmental_aspect->labor_id = $l->id;
                    $environmental_aspect->amount = $amount_aspect[$key];
                    $environmental_aspect->price = $price_aspect[$key];
                    $environmental_aspect->save();
                }
            }


            $executors = $request->input('executors_id');
            $employee_type = $validatedData['employement_type'];
            $hours = $validatedData['hours'];
            $price = $request->input('price');


            foreach ($executors as $key => $executor){   
                $e = new Executor;
                $e->labor_id = $l->id;
                $e->person_id = $executor;
                $e->employee_type_id = $employee_type[$key];
                $e->amount = $hours[$key];
                $e->price = $price[$key];
                $e->save();
            }

            $recipeRequest = $request->input('recipe');
            if($recipeRequest){
                $recipe = Formulation::where('id', $recipeRequest)->get();
                foreach($recipe as $r){ 
                    $element_id = $r->element_id;
                }
                $p = new Production;
                $p->labor_id = $l->id;
                $p->element_id = $element_id;
                $p->amount = $request->input('amount_production');
                $p->expiration_date = $request->input('date_experation');
                $p->lot = $request->input('lot');
                $p->save();
            }
            
            DB::commit();

            $icon = 'success';
            $message_line = trans('agroindustria::labors.laborSavedCorrectly');

            return redirect()->route('agroindustria.instructor.units.labor')->with([
                'icon' => $icon,
                'message_line' => $message_line,
            ]); 
        } catch (\Exception $e) {
            dd($e);
            // Rollback de la transacción en caso de error
            DB::rollBack();
    
            $icon = 'error';
            $message_line = trans('agroindustria::labors.errorWhenSavingWork');
            return redirect()->back()->withErrors($validatedData)->withInput()->with([
                'icon' => $icon,
                'message_line' => $message_line,
            ]);
        }  
    }
    
    public function cancelLabor($id){
        $labor = Labor::findOrFail($id);
        $labor->status = 'Cancelado';
        $labor->save();

        return redirect()->back()->with([
            'icon' => 'success',
            'message_line' => trans('agroindustria::labors.laborCorrectlyCancelled'),
        ]);
    }

    public function approbedLabor($id){
        $labor = Labor::findOrFail($id);
        $labor->status = 'Realizado';
        $labor->save();
    
        $production = Production::with('element')->where('labor_id', $id)->get();

        $laborProduction = Labor::where('id', $id)->get();
        if($production->count() > 0){
            foreach ($production as $p) {
                $element_id = $p->element_id;
                $price = $p->element->price;
                $amount = $p->amount;
                $lote = $p->lot;
                $expiration_date = $p->expiration_date;
            }
            foreach ($laborProduction as $l) {
                $activityId = $l->activity_id;
                $personId = $l->person_id;
                $destination = $l->destination;
                $status = $l->status;
            }
        

            $activity = Activity::where('id', $activityId)->pluck('productive_unit_id');
            $productive_unit_warehouse = ProductiveUnitWarehouse::where('productive_unit_id', $activity)->get();
            foreach ($productive_unit_warehouse as $pu) {
                $productive_unit_warehouse_id = $pu->id;
            }

            $n = new Inventory;
            $n->person_id = $personId;
            $n->productive_unit_warehouse_id = $productive_unit_warehouse_id;
            $n->element_id = $element_id;
            $n->destination = $destination;
            $n->price = $price;
            $n->amount = $amount;
            $n->stock = 10;
            $n->lot_number = $lote;
            $n->expiration_date = $expiration_date;
            $n->save();
        }
        

        $consumables = Consumable::where('labor_id', $id)->get();
        foreach($consumables as $c){
            $idConsumable = $c->inventory_id;
            $amounts = $c->amount;

            $inventories = Inventory::findOrFail($idConsumable);
            $inventories->amount -= $amounts;
            $inventories->save();
        }    

        return redirect()->back()->with([
            'icon' => 'success',
            'message_line' => trans('agroindustria::labors.workPerformedCorrectly'),
        ]);
    }

    public function movement(Request $request, $id){
        $labor = Labor::findOrFail($id);
        $labor->status = 'Realizado';
        $labor->save();

        $production = Production::where('labor_id', $id)->get();
        
        foreach ($production as $p) {
            $element_id = $p->element_id;
            $price = $p->element->price;
            $amount = $p->amount;
            $lote = $p->lot;
            $expiration_date = $p->expiration_date;
        }

        $laborProduction = Labor::where('id', $id)->where('destination', 'Producción')->get();
        foreach ($laborProduction as $l) {
            $activityId = $l->activity_id;
            $personId = $l->person_id;
            $destination = $l->destination;
            $status = $l->status;
        }

        $activity = Activity::where('id', $activityId)->pluck('productive_unit_id');
        $productive_unit_warehouse = ProductiveUnitWarehouse::where('productive_unit_id', $activity)->get();
        foreach ($productive_unit_warehouse as $pu) {
            $productive_unit_warehouse_id = $pu->id;
        }

        $n = new Inventory;
        $n->person_id = $personId;
        $n->productive_unit_warehouse_id = $productive_unit_warehouse_id;
        $n->element_id = $element_id;
        $n->destination = $destination;
        $n->price = $price;
        $n->amount = $amount;
        $n->stock = 10;
        $n->lot_number = $lote;
        $n->expiration_date = $expiration_date;
        $n->save();

        $movementType = MovementType::find(2);

        $totalPrice = $amount*$price;

        $mo = new Movement;
        $mo->registration_date = $request->input('date');
        $mo->movement_type_id = $movementType->id;
        $mo->voucher_number = $movementType->consecutive;
        $mo->price = $totalPrice;
        $mo->observation = $request->input('observations');
        $mo->state = 'Solicitado';
        $mo->save();

        $detail = new MovementDetail;
        $detail->movement_id = $mo->id;
        $detail->inventory_id = $n->id;
        $detail->amount = $amount;
        $detail->price = $price;
        $detail->save();

        $productive_unit_warehouse_pto = ProductiveUnitWarehouse::where('id', 1)->get();
        foreach ($productive_unit_warehouse_pto as $pto) {
            $productive_unit_warehouse_pto_id = $pto->id;
            $productive_unit_id = $pto->productive_unit->id;
        }
        
        $mr = new MovementResponsibility;
        $mr->person_id = $personId;
        $mr->movement_id = $mo->id;
        $mr->role = 'ENTREGA';
        $mr->date = $request->input('date');
        $mr->save();
        
        
        $receive_id = ProductiveUnit::where('id', $productive_unit_id)->pluck('person_id');
        foreach ($receive_id as $key => $r) {
            $mr = new MovementResponsibility;
            $mr->person_id = $r;
            $mr->movement_id = $mo->id;
            $mr->role = 'RECIBE';
            $mr->date = $request->input('date');
            $mr->save();
        }

        $wm = new WarehouseMovement;
        $wm->productive_unit_warehouse_id = $productive_unit_warehouse_id;
        $wm->movement_id = $mo->id;
        $wm->role = 'Entrega';
        $wm->save();

        $wm = new WarehouseMovement;
        $wm->productive_unit_warehouse_id = $productive_unit_warehouse_pto_id;
        $wm->movement_id = $mo->id;
        $wm->role = 'Recibe';
        $wm->save();
        
        $consumables = Consumable::where('labor_id', $id)->get();
        foreach($consumables as $c){
            $idConsumable = $c->inventory_id;
            $amounts = $c->amount;

            $inventories = Inventory::findOrFail($idConsumable);
            $inventories->amount -= $amounts;
            $inventories->save();
        }   

        return redirect()->back()->with([
            'icon' => 'success',
            'message_line' => trans('agroindustria::labors.workPerformedCorrectly'),
        ]);
    }

    public function rechazarSolicitud(Request $request, $id){

        $rules=[
            'observation' => 'required',
        ];
        $messages = [
            'observation.required' => trans('agroindustria::menu.Required field'),
        ];

        $validatedData = $request->validate($rules, $messages);
        $labor = Labor::find($id);
        if ($labor) {
            $labor->observations = $validatedData['observation'];
            $labor->save();
        }
        if($labor->save()){
            $icon = 'success';
            $message_line = 'Solicitud rechazada';
        }else{
            $icon = 'error';
            $message_line = 'Error al rechazar la solicitud';
        }

        return redirect()->route('cefa.agroindustria.storer.units.view.request')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);
    }
}

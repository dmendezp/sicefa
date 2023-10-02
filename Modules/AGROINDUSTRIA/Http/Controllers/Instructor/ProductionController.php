<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Inventory;
use Modules\AGROINDUSTRIA\Entities\Production;

class ProductionController extends Controller
{
    public function index(){
        $title = 'Producción';

        $production = Production::with('element')->get();
        foreach ($production as $p) {
            $laborId = $p->labor_id;
            $element_id = $p->element_id;
            $price = $p->element->price;
            $amount = $p->amount;
            $lote = $p->lot;
            $expiration_date = $p->expiration_date;
        }
        $labor = Labor::where('id', $laborId)->where('destination', 'Producción')->get();
        foreach ($labor as $l) {
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
        if($status === 'Realizado'){
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

        $data = [
            'title' => $title,
            'production' => $production
        ];
        return view('agroindustria::instructor.productions.table', $data);
    }
}

<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Modules\SICA\Entities\ProductiveUnit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsability;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\WarehouseMovement;

class DeliverController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function deliveries()
    {
        $title = 'Entregas';

        //Bodega que entrega
        $result = app(AGROINDUSTRIAController::class)->unidd();
        $warehouses = $result['warehouses'];        
        $warehouseDeliver = $warehouses->map(function ($w) {
            $warehouseId = $w->id;
            $warehouseName = $w->name;

            return [
                'id' => $warehouseId,
                'name' => $warehouseName,
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una Bodega'])->pluck('name', 'id');


        //Bodega que recibe
        $warehouseReceive = Warehouse::pluck('name','id');
        
        $data = [
            'title' => $title,
            'warehouseDeliver' => $warehouseDeliver,
            'warehouseReceive' => $warehouseReceive
        ];

        return view('agroindustria::instructor.deliveries', $data);
    }

}

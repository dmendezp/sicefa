<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;

class PUW extends Controller
{
    public static function getAppPuw(){
        // Verificar si la asociación de la unidad productiva y bodega ya se encuentra definida
        $app_puw = null;

        if (!$app_puw) {
            $productive_unit = ProductiveUnit::where('name', 'Punto de venta')->firstOrFail(); // Unidad productiva de la aplicación
            $warehouse = Warehouse::where('name', 'Punto de venta')->firstOrFail(); // Bodega de la aplicación
            $app_puw = ProductiveUnitWarehouse::where('productive_unit_id', $productive_unit->id)->where('warehouse_id', $warehouse->id)->firstOrFail();
        }

        return $app_puw;
    }

}

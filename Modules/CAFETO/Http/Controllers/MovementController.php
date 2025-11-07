<?php

namespace Modules\CAFETO\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\Person;

class MovementController extends Controller
{
    /* Vista principal de historico de movimientos */
    public function index()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_movement_index_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_movement_index_title_view')];
        $app_puw = PUW::getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        $start_date = Carbon::now()->startOfDay()->format('Y-m-d H:i:s'); // Fecha del actual con la primer hora del día
        $end_date = Carbon::now()->endOfDay()->format('Y-m-d H:i:s'); // Fecha del actual con la última hora del día
        $movements = Movement::whereHas('warehouse_movements', function ($query) use ($app_puw) {
                            $query->where('productive_unit_warehouse_id', $app_puw->id);
                            })->whereBetween('registration_date', [$start_date, $end_date])
                            ->orderBy('registration_date', 'DESC')
                            ->get();
        return view('cafeto::movements.index', compact('view', 'movements'));
    }

    /* Consultar movimientos por fecha y actor */
    public function consult(Request $request)
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_movement_index_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_movement_index_title_view')];
        $app_puw = PUW::getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        $start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay(); // Fecha inicial con la primer hora del día
        $end_date = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay(); // Fecha final con la última hora del día
        $movements = Movement::whereHas('warehouse_movements', function ($query) use ($app_puw) {
                            $query->where('productive_unit_warehouse_id', $app_puw->id);
                            })->whereBetween('registration_date', [$start_date, $end_date])
                            ->orderBy('registration_date', 'DESC')
                            ->get();
        $document_number = e($request->input('document_number'));
        if ($document_number) {
            $person = Person::where('document_number', $document_number)->first();
            if ($person) {
                // Consultar todos los movimientos que pertenenezcan a esta persona a partir de $movements filtrando por la relacion movement_responsabilities donde role sea CLIENTE o REGISTRO o ENTREGA y que person sea igual a $person->id, el resultado final deberían ser los movimientos que cumplan con las condiciones establecidas
                $roles = ['CLIENTE', 'REGISTRO', 'ENTREGA'];
                $filtered_movements = $person->movement_responsibilities
                    ->whereIn('role', $roles)
                    ->pluck('movement_id');
                $movements = $movements->whereIn('id', $filtered_movements);
            } else {
                $movements = [];
            }
        }
        return view('cafeto::movements.index', compact('view', 'movements'));
    }
}

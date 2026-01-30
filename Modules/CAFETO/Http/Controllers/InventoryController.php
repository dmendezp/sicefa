<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementType;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use TCPDF;

class InventoryController extends Controller
{
 public function index()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_inventory_index_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_inventory_index_title_view')
        ];

        $puw = PUW::getAppPuw();

        // =====================
        // Inventarios + populares (igual, pero exponiendo lote principal y origen)
        // =====================
        $inventories = Inventory::query()
            ->where('productive_unit_warehouse_id', $puw->id)
            ->with('element')
            ->get();

        $popularRanks = $this->getPopularRanks($puw->id);

        $groupedInventories = $inventories
            ->groupBy('element_id')
            ->map(function ($group) use ($popularRanks) {
                $group = $group->sortByDesc('updated_at')->values();
                $first = $group->first();

                $totalStock = (int) $group->sum('amount');

                // ✅ Si algún lote fue creado por formulación (token robusto en description)
                $madeByFormulation = $group->contains(function ($i) {
                    $d = (string) ($i->description ?? '');
                    return (bool) preg_match('/\[\s*FORM\s*:\s*\d+\s*\]/i', $d);
                });

                // ✅ Origen pedido: Agroindustria vs Formulación
                $origin = $madeByFormulation ? 'Formulación' : 'Agroindustria';

                // Lote principal (para mostrar destino/lote/fechas)
                $primaryLot = $group->first(fn($i) => (int)$i->amount > 0) ?? $group->first();

                $entryAvg = $group->count()
                    ? round((float) $group->avg('price'), 2)
                    : 0;

                $elementId = (int) $first->element_id;

                return (object) [
                    'element_id' => $elementId,
                    'slug'       => $first->element?->slug,
                    'name'       => $first->element?->name ?? 'Producto',
                    'sale_price' => (float) ($first->element?->price ?? 0),
                    'entry_price_avg' => $entryAvg,
                    'total_stock' => $totalStock,
                    'made_by_formulation' => $madeByFormulation,

                    // ✅ NUEVO (para Acciones)
                    'origin' => $origin,

                    'last_update' => $group->first()?->updated_at,
                    'primary_lot' => $primaryLot,
                    'popular_rank' => $popularRanks[$elementId] ?? null,

                    // ✅ Exponer datos del lote principal (tu blade ya los usa)
                    'destination' => $primaryLot?->destination,
                    'lot_number' => $primaryLot?->lot_number,
                    'production_date' => $primaryLot?->production_date,
                    'expiration_date' => $primaryLot?->expiration_date,
                ];
            })
            ->values()
            ->sortBy(function ($row) {
                $rank = $row->popular_rank ?? 999;
                return sprintf('%03d_%s', $rank, mb_strtolower($row->name));
            })
            ->values();

        $popularList = collect($popularRanks)
            ->sort()
            ->map(function ($rank, $elementId) use ($groupedInventories) {
                $row = $groupedInventories->firstWhere('element_id', (int) $elementId);
                return (object) [
                    'rank'       => $rank,
                    'element_id' => (int) $elementId,
                    'name'       => $row?->name ?? 'Producto',
                    'price'      => $row?->sale_price ?? null,
                ];
            })
            ->values();

        // =====================
        // ✅ CONSUMOS POR FORMULACIONES (SUMADOS SEGÚN VENTAS)
        //   - Agrupa por: fecha + formulación + producto consumido
        // =====================
        $consumptions = collect();

        $saleType = MovementType::where('name', 'Venta')->first();

        if ($saleType) {
            $sales = Movement::whereHas('warehouse_movements', function ($q) use ($puw) {
                    $q->where('productive_unit_warehouse_id', $puw->id)
                      ->where('role', 'Entrega');
                })
                ->where('movement_type_id', $saleType->id)
                ->where('state', 'Aprobado')
                ->with([
                    'movement_details.inventory' => function ($q) {
                        $q->with('element');
                    }
                ])
                ->orderBy('registration_date', 'DESC')
                ->get();

            $formulationCache = [];
            $bucket = []; // clave => acumulado

            foreach ($sales as $sale) {
                $date = optional($sale->registration_date)->format('Y-m-d') ?? (string)$sale->registration_date;

                foreach ($sale->movement_details as $detail) {
                    $inv = $detail->inventory;
                    if (!$inv) continue;

                    $desc = (string) ($inv->description ?? '');

                    // ✅ SOLO productos vendidos que vengan de formulación (token robusto)
                    if (!preg_match('/\[\s*FORM\s*:\s*(\d+)\s*\]/i', $desc, $m)) continue;

                    $formulationId = (int) $m[1];

                    if (!isset($formulationCache[$formulationId])) {
                        $formulationCache[$formulationId] = Formulation::with('ingredients.element', 'element')
                            ->find($formulationId);
                    }

                    $formulation = $formulationCache[$formulationId];
                    if (!$formulation) continue;

$soldQty = abs((float) ($detail->amount ?? 0)); // ✅ ventas suelen ir negativas
if ($soldQty <= 0) continue;


                    $producedName = $inv->element?->name
                        ?? ($formulation->element?->name ?? 'N/A');

                    foreach ($formulation->ingredients as $ingredient) {
                        $ingElId = (int) ($ingredient->element_id ?? 0);
                        $consumedName = $ingredient->element?->name ?? 'N/A';

                        // consumo total = consumo_unitario * cantidad vendida
                        $consumedAmount = (float) $ingredient->amount * $soldQty;

                        // ✅ Agrupar: fecha + formulación + ingrediente
                        $key = $date.'|'.$formulationId.'|'.$ingElId;

                        if (!isset($bucket[$key])) {
                            $bucket[$key] = (object) [
                                'formulation_id'   => $formulationId,
                                'date'             => $date,
                                'produced_product' => $producedName,
                                'consumed_product' => $consumedName,
                                'consumed_amount'  => 0.0,
                            ];
                        }

                        $bucket[$key]->consumed_amount += $consumedAmount;
                    }
                }
            }

            $consumptions = collect(array_values($bucket))
                ->sortByDesc('date')
                ->values();
        }

        return view('cafeto::inventory.index', compact(
            'view',
            'groupedInventories',
            'consumptions',
            'popularRanks',
            'popularList'
        ));
    }







 public function togglePopular($elementId)
    {
        $puw = PUW::getAppPuw();

        $inventories = Inventory::query()
            ->where('productive_unit_warehouse_id', $puw->id)
            ->where('element_id', $elementId)
            ->get();

        if ($inventories->isEmpty()) {
            return redirect()->back()->with('error', 'No hay inventario para este producto.');
        }

        $popularRanks = $this->getPopularRanks($puw->id);
        $currentRank  = $popularRanks[$elementId] ?? null;

        if ($currentRank !== null) {
            $this->removePopularTokenFromElement($puw->id, $elementId);

            foreach ($popularRanks as $eId => $rank) {
                if ((int)$eId === (int)$elementId) continue;
                if ($rank > $currentRank) {
                    $this->setPopularRankOnElement($puw->id, (int)$eId, $rank - 1);
                }
            }

            return redirect()->back()->with('success', 'Producto removido de Populares.');
        }

        $count = count($popularRanks);

        if ($count < 4) {
            $newRank = $count + 1;
            $this->setPopularRankOnElement($puw->id, $elementId, $newRank);
            return redirect()->back()->with('success', "Producto marcado como Popular (#{$newRank}).");
        }

        $oldestElementId = collect($popularRanks)->sort()->keys()->first();

        $this->removePopularTokenFromElement($puw->id, (int)$oldestElementId);

        foreach ($popularRanks as $eId => $rank) {
            $eId = (int)$eId;
            if ($eId === (int)$oldestElementId) continue;
            $this->setPopularRankOnElement($puw->id, $eId, $rank - 1);
        }

        $this->setPopularRankOnElement($puw->id, $elementId, 4);

        return redirect()->back()->with('success', 'Favorito actualizado: se reemplazó el más antiguo y este quedó como Popular (#4).');
    }

    private function getPopularRanks(int $puwId): array
    {
        $rows = Inventory::query()
            ->where('productive_unit_warehouse_id', $puwId)
            ->whereNotNull('description')
            ->where('description', 'like', '%[POP%')
            ->get(['element_id', 'description']);

        $map = [];

        foreach ($rows as $row) {
            $rank = $this->parsePopularRank((string)$row->description);
            if ($rank === null) continue;
            $eid = (int)$row->element_id;
            if (!isset($map[$eid]) || $rank < $map[$eid]) {
                $map[$eid] = $rank;
            }
        }

        asort($map);
        $normalized = [];
        $i = 1;
        foreach ($map as $eid => $rank) {
            $normalized[(int)$eid] = $i;
            $i++;
            if ($i > 4) break;
        }

        foreach ($normalized as $eid => $rank) {
            $this->setPopularRankOnElement($puwId, $eid, $rank);
        }

        return $normalized;
    }

    private function parsePopularRank(string $desc): ?int
    {
        if (preg_match('/\[POP:(\d)\]/', $desc, $m)) {
            $r = (int)$m[1];
            return ($r >= 1 && $r <= 4) ? $r : null;
        }
        if (str_contains($desc, '[POP]')) {
            return 4;
        }
        return null;
    }

    private function removePopularToken(string $desc): string
    {
        $desc = preg_replace('/\s*\[POP(:\d)?\]\s*/', ' ', $desc);
        $desc = preg_replace('/\s+/', ' ', $desc);
        return trim($desc);
    }

    private function setPopularToken(string $desc, int $rank): string
    {
        $desc = $this->removePopularToken($desc);
        $token = "[POP:{$rank}]";
        return trim($desc . ' ' . $token);
    }

    private function removePopularTokenFromElement(int $puwId, int $elementId): void
    {
        $inventories = Inventory::where('productive_unit_warehouse_id', $puwId)
            ->where('element_id', $elementId)
            ->get();

        foreach ($inventories as $inv) {
            $desc = (string)($inv->description ?? '');
            $desc = $this->removePopularToken($desc);
            $inv->description = $desc !== '' ? $desc : null;
            $inv->save();
        }
    }

    private function setPopularRankOnElement(int $puwId, int $elementId, int $rank): void
    {
        $inventories = Inventory::where('productive_unit_warehouse_id', $puwId)
            ->where('element_id', $elementId)
            ->get();

        foreach ($inventories as $inv) {
            $desc = (string)($inv->description ?? '');
            $desc = $this->setPopularToken($desc, $rank);
            $inv->description = $desc;
            $inv->save();
        }
    }


  public function create()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_create_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_create_title_view')];
        return view('cafeto::inventory.create', compact('view'));
    }

    public function store(Request $request)
    {
        $puw = PUW::getAppPuw();

        $rawAmount =
            $request->input('amount')
            ?? $request->input('cantidad')
            ?? $request->input('quantity')
            ?? $request->input('stock')
            ?? $request->input('entry_amount');

        $amount = (int) preg_replace('/[^\d]/', '', (string) $rawAmount);

        $rawPrice = $request->input('price', 0);
        $price = (float) preg_replace('/[^\d]/', '', (string) $rawPrice);

        \Log::info('CAFETO inventory.store payload', [
            'route' => optional(\Route::current())->getName(),
            'element_id' => $request->input('element_id'),
            'rawAmount' => $rawAmount,
            'amountParsed' => $amount,
            'rawPrice' => $rawPrice,
            'priceParsed' => $price,
            'lot_number' => $request->input('lot_number'),
            'puw_id' => optional($puw)->id,
            'all_keys' => array_keys($request->all()),
        ]);

        $validator = Validator::make([
            'element_id' => $request->input('element_id'),
            'amount'     => $amount,
            'price'      => $price,
            'lot_number' => $request->input('lot_number'),
            'production_date' => $request->input('production_date'),
            'expiration_date' => $request->input('expiration_date'),
        ], [
            'element_id' => 'required|integer|exists:elements,id',
            'amount'     => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
            'lot_number' => 'required|string|max:50',
            'production_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:production_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $inventory = Inventory::query()
                ->where('productive_unit_warehouse_id', $puw->id)
                ->where('element_id', (int)$request->input('element_id'))
                ->where('lot_number', $request->input('lot_number'))
                ->first();

            if ($inventory) {
                $inventory->amount = (int)$inventory->amount + $amount;
            } else {
                $inventory = new Inventory();
                $inventory->productive_unit_warehouse_id = $puw->id;
                $inventory->element_id = (int)$request->input('element_id');
                $inventory->lot_number = $request->input('lot_number');
                $inventory->amount = $amount;
            }

            $inventory->price = $price;

            if ($request->filled('destination')) $inventory->destination = $request->input('destination');
            if ($request->filled('production_date')) $inventory->production_date = $request->input('production_date');
            if ($request->filled('expiration_date')) $inventory->expiration_date = $request->input('expiration_date');

            $inventory->save();

            DB::commit();

            return redirect()
                ->route('cafeto.' . getRoleRouteName(\Route::currentRouteName()) . '.inventory.index')
                ->with('success', 'Entrada de inventario registrada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('CAFETO inventory.store error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Error registrando inventario.')->withInput();
        }
    }

    public function status(Request $request)
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_status_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_status_title_view')];
        $productosVencidos = Inventory::where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('state', 'Disponible')
            ->where('expiration_date', '<', now())
            ->orderBy('expiration_date')
            ->get();
        $productosPorVencer = Inventory::where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('state', 'Disponible')
            ->where('expiration_date', '>', now())
            ->where('expiration_date', '<=', now()->addDays(3))
            ->orderBy('expiration_date')
            ->get();
        return view('cafeto::inventory.status', compact('view', 'productosVencidos', 'productosPorVencer'));
    }

    public function low_create()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_low_create_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_low_create_title_view')];
        return view('cafeto::inventory.low', compact('view'));
    }

    public function show_entry(Movement $movement)
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_show_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_show_title_view')];
        return view('cafeto::inventory.show-entry', compact('view', 'movement'));
    }

    public function showLow(Movement $movement)
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_show_low_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_show_low_title_view')];
        return view('cafeto::inventory.show-low', compact('view', 'movement'));
    }

    public function reports()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_reports_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_reports_title_view')];
        return view('cafeto::reports.index', compact('view'));
    }

    public function generateInventoryPDF(Request $request)
    {
        $inventories = Inventory::where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
        // temporal para depurar
// ->where('amount', '<>', 0)

            ->orderBy('updated_at', 'DESC')
            ->get();

        $puw = PUW::getAppPuw();

        $groupedInventories = collect();
        $groups = [];

        foreach ($inventories as $inventory) {
            $elementId = $inventory->element_id;
            if (array_key_exists($elementId, $groups)) {
                $groups[$elementId]->push($inventory);
            } else {
                $groups[$elementId] = collect([$inventory]);
            }
        }

        foreach ($groups as $group) {
            $groupedInventories->push($group);
        }

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $title = 'Reporte de Inventario - ' . date('Y-m-d');
        $pdf->SetTitle($title);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        $pdf->SetY(15);
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 1, 'C');

        $html = '<h4 style="text-align: center;"><strong>Bodega:</strong> ' . $puw->warehouse->name . ' - <strong>Unidad Productiva:</strong> ' . $puw->productive_unit->name . '</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;"><b>#</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 130px;"><b>Producto</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 45px;"><b>N° Lote</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;"><b>Fecha Producción</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;"><b>Fecha Vencimiento</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;"><b>Cantidad</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;"><b>Precio Entrada</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;"><b>Precio Venta</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 62px;"><b>Existencias</b></th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($groupedInventories as $key => $group) {
            $firstRecord = $group->first();
            $rowspan = $group->count();
            $html .= '<tr>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 25px;">' . ($key + 1) . '</td>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 130px;">' . $firstRecord->element->name . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 45px;">' . $firstRecord->lot_number . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;">' . $firstRecord->production_date . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;">' . $firstRecord->expiration_date . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;">' . $firstRecord->amount . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;">' . priceFormat($firstRecord->price) . '</td>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;">' . priceFormat($firstRecord->element->price) . '</td>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 62px;">' . $group->sum('amount') . '</td>';
            $html .= '</tr>';
            foreach ($group->slice(1) as $record) {
                $html .= '<tr>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $record->lot_number . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $record->production_date . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $record->expiration_date . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $record->amount . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($record->price) . '</td>';
                $html .= '</tr>';
            }
        }

        $html .= '</tbody>';
        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $filename = 'reporte_inventarios_' . date('Ymd') . '.pdf';
        $pdf->Output($filename, 'I');
    }

    public function showInventoryEntriesForm()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_show_entries_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_show_entries_title_view')];
        $start_date = request()->input('start_date', now()->format('Y-m-d'));
        $end_date = request()->input('end_date', now()->format('Y-m-d'));

        return view('cafeto::reports.inventory-entries-form', compact('view', 'start_date', 'end_date'));
    }

    public function generateInventoryEntries(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        $startDateInput = Carbon::parse($startDateInput)->format('Y-m-d');
        $endDateInput = Carbon::parse($endDateInput)->format('Y-m-d');

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateInput)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDateInput)->endOfDay();

        $movement_type = MovementType::where('name', 'Movimiento Interno')->firstOrFail();

        $movements = Movement::whereHas('warehouse_movements', function ($query) {
            $query->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('role', 'Recibe');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        return $this->showInventoryEntriesForm()->with('movements', $movements);
    }

    public function generateInventoryEntriesPDF(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        $startDateInput = Carbon::parse($startDateInput)->format('Y-m-d');
        $endDateInput = Carbon::parse($endDateInput)->format('Y-m-d');

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateInput)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDateInput)->endOfDay();

        $movement_type = MovementType::where('name', 'Movimiento Interno')->firstOrFail();

        $movements = Movement::whereHas('warehouse_movements', function ($query) {
            $query->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('role', 'Recibe');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        $puw = PUW::getAppPuw();

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $title = 'Reporte de Entradas de Inventario - ' . $startDateInput . ' al ' . $endDateInput;
        $pdf->SetTitle($title);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        $pdf->SetY(15);
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 1, 'C');

        $html = '<h4 style="text-align: center;"><strong>Bodega:</strong> ' . $puw->warehouse->name . ' - <strong>Unidad Productiva:</strong> ' . $puw->productive_unit->name . '</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;"><b>#</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 52px;"><b>N° de Voucher</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;"><b>Responsable que entrega</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><b>Fecha de ingreso</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;"><b>Producto</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Cantidad</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Precio</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Subtotal</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Total</b></th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($movements as $key => $movement) {
            foreach ($movement->movement_details as $index => $movement_detail) {
                $html .= '<tr>';
                if ($index === 0) {
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 25px;" rowspan="' . count($movement->movement_details) . '">' . ($key + 1) . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 52px;" rowspan="' . count($movement->movement_details) . '">' . $movement->voucher_number . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;" rowspan="' . count($movement->movement_details) . '">' . $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;" rowspan="' . count($movement->movement_details) . '">' . $movement->registration_date . '</td>';
                }
                $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;">' . $movement_detail->inventory->element->product_name . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $movement_detail->amount . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($movement_detail->price) . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($movement_detail->amount * $movement_detail->price) . '</td>';
                if ($index === 0) {
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;" rowspan="' . count($movement->movement_details) . '">' . priceFormat($movement->price) . '</td>';
                }
                $html .= '</tr>';
            }
        }

        $html .= '</tbody>';
        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $filename = 'Reporte_entradas_inventario_' . $startDateInput . '_al_' . $endDateInput . '.pdf';
        $pdf->Output($filename, 'I');
    }

    public function showSalesForm()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_sales_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_sales_title_view')];
        $start_date = request()->input('start_date', now()->format('Y-m-d'));
        $end_date = request()->input('end_date', now()->format('Y-m-d'));

        return view('cafeto::reports.sales-form', compact('view', 'start_date', 'end_date'));
    }

    public function generateSales(Request $request)
    {
        $startDateInput = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $endDateInput   = Carbon::parse($request->input('end_date'))->format('Y-m-d');
        $startDate = Carbon::createFromFormat('Y-m-d', $startDateInput)->startOfDay();
        $endDate   = Carbon::createFromFormat('Y-m-d', $endDateInput)->endOfDay();

        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();

        $movements = Movement::whereHas('warehouse_movements', function ($q) {
                $q->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                  ->where('role', 'Entrega');
            })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        $groupedProducts = [];
        foreach ($movements as $movement) {
            foreach ($movement->movement_details as $detail) {
                $el   = $detail->inventory->element;
                $name = $el->product_name ?? 'N/A';
                $key  = $name;

                $price = $detail->price;
                $amount = $detail->amount;
                $subtotal = $amount * $price;

                if (!isset($groupedProducts[$key])) {
                    $groupedProducts[$key] = [
                        'producto'   => $name,
                        'cantidad'   => 0,
                        'min_price'  => $price,
                        'max_price'  => $price,
                        'subtotal'   => 0,
                    ];
                }
                $groupedProducts[$key]['cantidad'] += $amount;
                $groupedProducts[$key]['subtotal'] += $subtotal;
                $groupedProducts[$key]['min_price'] = min($groupedProducts[$key]['min_price'], $price);
                $groupedProducts[$key]['max_price'] = max($groupedProducts[$key]['max_price'], $price);
            }
        }

        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_sales_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_sales_title_view')
        ];

        return view('cafeto::reports.sales-form', [
            'view'          => $view,
            'start_date'    => $startDateInput,
            'end_date'      => $endDateInput,
            'movements'     => $movements,
            'groupedProducts' => array_values($groupedProducts),
        ]);
    }

    public function generateSalesProductsPDF(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput   = $request->input('end_date');
        if (!$startDateInput || !$endDateInput) {
            return redirect()->back()->withErrors(['error' => 'Las fechas de inicio y fin son obligatorias.']);
        }

        $startDate = Carbon::parse($startDateInput)->startOfDay();
        $endDate   = Carbon::parse($endDateInput)->endOfDay();

        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();
        $movements = Movement::whereHas('warehouse_movements', function ($q) {
                $q->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                  ->where('role', 'Entrega');
            })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        $grouped = [];
        foreach ($movements as $movement) {
            foreach ($movement->movement_details as $detail) {
                $el   = $detail->inventory->element;
                $name = optional($el)->product_name ?? 'N/A';
                $key  = $name;

                $price = $detail->price ?? 0;
                $amount = $detail->amount ?? 0;
                $subtotal = $amount * $price;

                if (!isset($grouped[$key])) {
                    $grouped[$key] = [
                        'producto'   => $name,
                        'cantidad'   => 0,
                        'min_price'  => $price,
                        'max_price'  => $price,
                        'subtotal'   => 0,
                    ];
                }
                $grouped[$key]['cantidad'] += $amount;
                $grouped[$key]['subtotal'] += $subtotal;
                $grouped[$key]['min_price'] = min($grouped[$key]['min_price'], $price);
                $grouped[$key]['max_price'] = max($grouped[$key]['max_price'], $price);
            }
        }

        ksort($grouped);

        $puw = PUW::getAppPuw();
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $title = 'Reporte de Productos Vendidos - '.$startDateInput.' al '.$endDateInput;
        $pdf->SetTitle($title);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        $pdf->SetY(15);
        $pdf->Cell(0, 0, 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila', 0, 1, 'C');

        $html  = '<h4 style="text-align:center;"><strong>Bodega:</strong> '.$puw->warehouse->name.' - <strong>Unidad Productiva:</strong> '.$puw->productive_unit->name.'</h4>';
        $html .= '<h3 style="text-align:center;">'.$title.'</h3>';
        
        $html .= '<table style="border-collapse:collapse; width:100%; font-size:10pt; border:1px solid #000;">';
        $html .= '<thead style="background-color:#f2f2f2; border-bottom:2px solid #000;"><tr>
            <th style="border:1px solid #000; text-align:center; padding:10px; width:5%;"><strong>#</strong></th>
            <th style="border:1px solid #000; text-align:right; padding:10px; width:35%;"><strong>Producto</strong></th>
            <th style="border:1px solid #000; text-align:center; padding:10px; width:20%;"><strong>Cantidad</strong></th>
            <th style="border:1px solid #000; text-align:center; padding:10px; width:20%;"><strong>Precio</strong></th>
            <th style="border:1px solid #000; text-align:center; padding:10px; width:20%;"><strong>Subtotal</strong></th>
        </tr></thead><tbody>';

        $total = 0; $i = 0;
        if (empty($grouped)) {
            $html .= '<tr><td colspan="5" style="text-align:center; padding:10px; border:1px solid #000;">No hay datos para el rango seleccionado.</td></tr>';
        } else {
            foreach ($grouped as $item) {
                $i++;
                $total += $item['subtotal'];
                $priceLabel = ($item['min_price'] == $item['max_price'])
                    ? priceFormat($item['min_price'])
                    : priceFormat($item['min_price']) . ' - ' . priceFormat($item['max_price']);
                $cantidad = number_format($item['cantidad'], 0, '.', ',');

                $html .= "<tr>
                    <td style='border:1px solid #000; text-align:center; padding:10px;'>{$i}</td>
                    <td style='border:1px solid #000; text-align:right; padding:10px;'>{$item['producto']}</td>
                    <td style='border:1px solid #000; text-align:center; padding:10px;'>{$cantidad}</td>
                    <td style='border:1px solid #000; text-align:center; padding:10px;'>{$priceLabel}</td>
                    <td style='border:1px solid #000; text-align:center; padding:10px;'>".priceFormat($item['subtotal'])."</td>
                </tr>";
            }
        }

        $html .= '</tbody><tfoot><tr>
            <td colspan="4" style="border:1px solid #000; text-align:right; padding:10px; font-weight:bold; background-color:#f2f2f2;">Total General:</td>
            <td style="border:1px solid #000; text-align:center; padding:10px; font-weight:bold; background-color:#f2f2f2;">'.priceFormat($total).'</td>
        </tr></tfoot></table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $filename = 'Reporte_productos_vendidos_'.$startDateInput.'_al_'.$endDateInput.'.pdf';
        $pdf->Output($filename, 'I');
    }

    public function generateSalesPDF(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        $startDateInput = Carbon::parse($startDateInput)->format('Y-m-d');
        $endDateInput = Carbon::parse($endDateInput)->format('Y-m-d');

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateInput)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDateInput)->endOfDay();

        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();

        $movements = Movement::whereHas('warehouse_movements', function ($query) {
            $query->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                  ->where('role', 'Entrega');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        $puw = PUW::getAppPuw();

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $title = 'Reporte de Ventas - ' . $startDateInput . ' al ' . $endDateInput;
        $pdf->SetTitle($title);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        $pdf->SetY(15);
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 1, 'C');

        $html = '<h4 style="text-align: center;"><strong>Bodega:</strong> ' . $puw->warehouse->name . ' - <strong>Unidad Productiva:</strong> ' . $puw->productive_unit->name . '</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;"><b>#</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 52px;"><b>N° Comprobante</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;"><b>Cliente</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><b>Fecha de ingreso</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;"><b>Producto</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Cantidad</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Precio</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Subtotal</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Total</b></th>';
        $html .= '</tr>';
        $html .= '</thead>';

        $totalTotal = 0;

        $html .= '<tbody>';
        foreach ($movements as $key => $movement) {
            foreach ($movement->movement_details as $index => $movement_detail) {
                $html .= '<tr>';
                if ($index === 0) {
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 25px;" rowspan="' . count($movement->movement_details) . '">' . ($key + 1) . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 52px;" rowspan="' . count($movement->movement_details) . '">' . $movement->voucher_number . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;" rowspan="' . count($movement->movement_details) . '">' . $movement->movement_responsibilities->where('role', 'CLIENTE')->first()->person->full_name . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;" rowspan="' . count($movement->movement_details) . '">' . $movement->registration_date . '</td>';
                }
                $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;">' . $movement_detail->inventory->element->product_name . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $movement_detail->amount . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($movement_detail->price) . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($movement_detail->amount * $movement_detail->price) . '</td>';
                if ($index === 0) {
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;" rowspan="' . count($movement->movement_details) . '">' . priceFormat($movement->price) . '</td>';
                }
                $html .= '</tr>';
            }
            $totalTotal += $movement->price;
        }
        $html .= '</tbody>';

        $html .= '<tfoot>';
        $html .= '<tr>';
        $html .= '<td style="border: 1px solid #dddddd; text-align: right; padding: 8px; width: 478px;"><strong> Total: </strong></td>';
        $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 60px;"><strong>' . priceFormat($totalTotal) . '</strong></td>';
        $html .= '</tr>';
        $html .= '</tfoot>';
        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $filename = 'Reporte_ventas_' . $startDateInput . '_al_' . $endDateInput . '.pdf';
        $pdf->Output($filename, 'I');
    }
}
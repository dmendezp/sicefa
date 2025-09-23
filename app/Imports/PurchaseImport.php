<?php

namespace App\Imports;

use Maatwebsite\Excel\Row;
use Illuminate\Support\Str;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Element;
use Illuminate\Support\Facades\Log;
use Modules\GDMF\Entities\Purchase;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Modules\GDMF\Entities\PurchaseDetail;
use Modules\GDMF\Entities\MaterialRequest;
use Modules\SIGAC\Entities\TrainingProject;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\GDMF\Entities\MaterialRequestItem;
use Modules\GDMF\Entities\AnnualBudgetTrainingProject;
use Modules\GDMF\Entities\PurchaseFailure;

class PurchaseImport implements OnEachRow, WithHeadingRow, WithValidation
{
    public $errores = [];
    public $exitos = [];
    protected $fileHash;

    public function __construct($fileHash)
    {
        $this->fileHash = $fileHash;
    }

    public function headingRow(): int
    {
        return 2;
    }
    public function rules(): array
    {
        return [];
    }

    protected function guardarFallo($purchase, $instructor, $producto, $unspsc, $reason)
    {
        PurchaseFailure::create([
            'purchase_id' => $purchase?->id,
            'file_hash' => $this->fileHash,
            'instructor_name' => $instructor,
            'product_name' => $producto,
            'unspsc_code' => $unspsc,
            'reason' => $reason,
        ]);
        $this->errores[] = "$reason ($instructor - $producto)";
    }

    public function onRow(Row $row)
    {
        static $purchase = null;

        try {
            $data = $row->toArray();
            $codigoUnspsc = $data['codigo_unspsc'] ?? null;
            $producto = $data['producto'] ?? null;
            $unit_price = intval($data['valor_unitario'] ?? 0);

            $element = Element::where('UNSPSC_code', $codigoUnspsc)
                ->orWhere('name', $producto)
                ->first();

            if (!$element) {
                $this->guardarFallo($purchase, null, $producto, $codigoUnspsc, "Elemento no encontrado");
                return;
            }

            if (is_null($purchase)) {
                $purchase = Purchase::create([
                    'purchase_date' => now(),
                    'total_amount' => 0,
                    'observation' => 'Importación desde archivo Excel',
                ]);
            }

            $no_instructores = [
                'item',
                'codigo_almacen',
                'codigo_unspsc',
                'producto',
                'descripcion',
                'unidad',
                'requerimiento',
                'valor_unitario',
                'total'
            ];

            foreach ($data as $col => $cantidadSolicitada) {
                if (in_array($col, $no_instructores)) continue;

                $cantidad = intval($cantidadSolicitada);
                if ($cantidad <= 0) continue;

                $parts = explode('_', $col);

                if (count($parts) > 1) {
                    // ❗ Quita la última parte
                    array_pop($parts);
                }

                $instructorNombre = implode(' ', $parts);

                $instructorNombre = mb_strtoupper(trim($instructorNombre));

                

                $person = Person::whereRaw("UPPER(CONCAT(first_name, ' ', first_last_name, ' ', COALESCE(second_last_name, ''))) = ?", [$instructorNombre])->first();

                if (!$person) {
                    $this->guardarFallo($purchase, $instructorNombre, $producto, $codigoUnspsc, "Instructor no encontrado");
                    continue;
                }

                $request = MaterialRequest::where('person_id', $person->id)->latest()->first();
                if (!$request) {
                    $this->guardarFallo($purchase, $instructorNombre, $producto, $codigoUnspsc, "No se encontró solicitud de materiales");
                    continue;
                }

                $project = TrainingProject::find($request->training_project_id);
                if (!$project || !$project->training_materials()->where('element_id', $element->id)->exists()) {
                    $this->guardarFallo($purchase, $instructorNombre, $producto, $codigoUnspsc, "Material no pertenece al proyecto");
                    continue;
                }

                // ❗ Revisar si ya existe para este archivo
                $exists = PurchaseDetail::where([
                    'purchase_id' => $purchase->id,
                    'material_request_id' => $request->id,
                    'element_id' => $element->id,
                ])->exists();

                if ($exists) continue;

                $budget = AnnualBudgetTrainingProject::where('training_project_id', $project->id)
                    ->whereHas('annual_budget', fn($q) => $q->where('year', now()->year))
                    ->first();

                $subtotal = $unit_price * $cantidad;
                $available = $budget?->budget_current ?? 0;

                $funding = 'Proyecto';
                if ($available <= 0) {
                    $funding = 'Produccion';
                } elseif ($available < $subtotal) {
                    $funding = 'Mixto';
                }

                // Descuento de presupuesto
                if ($funding == 'Proyecto') {
                    $budget->budget_current -= $subtotal;
                    $budget->save();
                } elseif ($funding == 'Mixto') {
                    $budget->budget_current = 0;
                    $budget->save();
                }

                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'material_request_id' => $request->id,
                    'element_id' => $element->id,
                    'quantity' => $cantidad,
                    'unit_price' => $unit_price,
                    'subtotal' => $subtotal,
                    'financed_by' => $funding,
                ]);

                $purchase->total_amount += $subtotal;
                $purchase->save();

                $this->exitos[] = "Registrado: {$instructorNombre} - {$producto} x {$cantidad}";
            }
        } catch (\Throwable $e) {
            $this->guardarFallo($purchase, null, $producto, $codigoUnspsc, "Error inesperado: " . $e->getMessage());
        }
    }
}
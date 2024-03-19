<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use DateInterval;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\SENAEMPRESA\Entities\Loan;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Inventory;
use TCPDF;

class LoanController extends Controller
{
    public function loans(Request $request)
    {
        $loanState = $request->input('loan_state');
        $user = Auth::user();

        if ($user->roles[0]->name === 'Aprendiz Senaempresa' || Route::is('senaempresa.apprentice.*')) {
            // If the user is an apprentice, retrieve only their loans
            $apprentice = $user->person->apprentices()->first();
            $loans = $apprentice ? $apprentice->loans()->when($loanState, function ($query) use ($loanState) {
                return $query->where('state', $loanState);
            })->get() : collect(); // Use collect() to create an empty collection if apprentice is not found
        } else {
            // If the user is not an apprentice, retrieve all loans
            $loans = Loan::when($loanState, function ($query) use ($loanState) {
                return $query->where('state', $loanState);
            })->get();
        }

        $apprentices = Apprentice::with('Person')->get();
        $inventories = Inventory::with('Element')
            ->where('state', 'Disponible')
            ->get();

        $data = [
            'title' => trans('senaempresa::menu.Registered Loans'),
            'loans' => $loans,
            'apprentices' => $apprentices,
            'inventories' => $inventories,
        ];

        return view('senaempresa::Company.loans.index', $data);
    }

    public function generateLoansPDF(Request $request)
    {
        // Obtener los datos de los préstamos
        $loans = Loan::with(['apprentice', 'inventory'])
        ->where('state', 'Prestado') // Filtrar préstamos prestados
        ->get();

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Establecer el título del documento con la fecha y hora actual en formato 12 horas
        $title = trans('senaempresa::menu.Loans') . ' - ' . date('Y-m-d h:i:s A');
        $pdf->SetTitle($title);

        // Definir la fuente y el tamaño para el contenido del PDF
        $pdf->SetFont('helvetica', '', 10);

        // Agregar una nueva página
        $pdf->AddPage();

        $tableStyle = 'border-collapse: collapse; width: 500px; margin: auto; text-align: center;';
        $cellStyle = 'border: 1px solid #000; text-align: center; padding: 0 auto 8px; height: 14px; ';

        // Agregar el logo en la parte izquierda superior
        $logoPath = public_path('AdminLTE/dist/img/logo P SENA.png'); // Reemplaza con la ruta de tu logo
        $pdf->Image($logoPath, 175, 15, 22, '', 'PNG');  // Ajusta las coordenadas y el espacio entre el logo y la tabla

        // Método Header para establecer el contenido centrado del encabezado
        $pdf->SetY(15); // Ajustar la posición vertical del texto del encabezado
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 8, 'C');

        // Establecer el contenido del PDF
        $html = '<h4 style="text-align: center;">SENAEMPRESA</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';
        $html .= '<table style="' . $tableStyle . '">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; text-align: center; padding: 0 auto 8px; width: 20px; height: 14px;">ID</th>';
        $html .= '<th style="border: 1px solid #000; text-align: center; padding: 0 auto 8px; width: 120px; height: 14px;">' . trans('senaempresa::menu.Apprentice') . ':</th>';
        $html .= '<th style="' . $cellStyle . '">' . trans('senaempresa::menu.Element') . ':</th>';
        $html .= '<th style="' . $cellStyle . '">' . trans('senaempresa::menu.Start date and time') . ':</th>';
        $html .= '<th style="' . $cellStyle . '">' . trans('senaempresa::menu.End date and time') . ':</th>';
        $html .= '<th style="' . $cellStyle . '">' . trans('senaempresa::menu.Status') . ':</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($loans as $loan) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; text-align: center; padding: 0 auto 8px; width: 20px; height: 14px;">' . $loan->id . '</td>';
            $html .= '<td style="border: 1px solid #000; text-align: center; padding: 0 auto 8px; width: 120px; height: 14px;">' . $loan->apprentice->person->full_name . '</td>';
            $html .= '<td style="' . $cellStyle . '">' . $loan->inventory->Element->name . '</td>';
            $html .= '<td style="' . $cellStyle . '">' . $loan->start_datetime . '</td>';

            if ($loan->end_datetime == null) {
                $html .= '<td style="' . $cellStyle . '">Sin Entregar</td>';
            } else {
                $html .= '<td style="' . $cellStyle . '">' . $loan->end_datetime . '</td>';
            }

            $html .= '<td style="' . $cellStyle . '">' . $loan->state . '</td>';

            $html .= '</tr>';
        }


        $html .= '</tbody>';
        $html .= '</table>';

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C');

        // Generar el PDF y devolverlo para su descarga con la fecha en el nombre del archivo
        $filename = trans('senaempresa::menu.SENAEmpresa_loans') . date('Ymd') . '.pdf';
        $pdf->Output($filename, 'I');

    }


    public function return ($id)
    {
        // Busca el préstamo por su ID
        $loan = Loan::find($id);

        if ($loan) {
            // Obtén la fecha y hora actual
            $currentDateTime = now();

            // Actualiza la fecha y hora de finalización con la fecha y hora actual
            $loan->end_datetime = $currentDateTime;

            // Actualiza el estado a "Devuelto"
            $loan->state = 'Devuelto';
            $loan->save();

            // Aumenta la cantidad en el inventario
            $inventory = Inventory::find($loan->inventory_id);
            if ($inventory) {
                $inventory->amount += 1;
                $inventory->save();
            }

            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index')->with('success', trans('senaempresa::menu.Loan successfully repaid.'));
        } else {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index')->with('error', trans('senaempresa::menu.The loan was not found.'));
        }
    }

    public function new()
    {
        $loans = Loan::get();
        $apprentices = Apprentice::with('Person')->get();

        // Filtra los inventarios con estado "Disponible" y que tengan elementos de categoría "SENAEMPRESA_EPP"
        $inventories = Inventory::with(['Element.Category'])
            ->where('state', 'Disponible')
            ->whereHas('Element.Category', function ($query) {
                $query->where('name', 'SENAEMPRESA_EPP');
            })
            ->get();

        $data = [
            'title' => trans('senaempresa::menu.New Loan'),
            'loans' => $loans,
            'apprentices' => $apprentices,
            'inventories' => $inventories,
        ];

        return view('senaempresa::Company.loans.new', $data);
    }

    public function saved(Request $request)
    {
        $inventory = Inventory::find($request->input('inventory_id'));

        // Verificar si el inventario existe y la cantidad es suficiente
        if ($inventory && $inventory->amount >= 1) {
            $loan = new Loan();
            $loan->apprentice_id = $request->input('apprentice_id');
            $loan->inventory_id = $request->input('inventory_id');
            $loan->start_datetime = $request->input('start_datetime');
            $loan->state = 'Prestado';

            if ($loan->save()) {
                // Actualizar la cantidad en el inventario
                $inventory->amount -= 1;
                $inventory->save();

                // Indicar que se debe mostrar el formulario después de redirigir
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index')->with('showForm', true)->with('success', trans('senaempresa::menu.Loan added successfully.'));
            }
        } else {
            // La cantidad en el inventario no es suficiente
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index')->with('info', trans('senaempresa::menu.There is not enough in the inventory to make the loan.'));
        }
    }



    public function edit($id)
    {
        $loan = Loan::find($id);
        $apprentices = Apprentice::with('Person')->get();
        $inventories = Inventory::with(['Element.Category'])
            ->where('state', 'Disponible')
            ->whereHas('Element.Category', function ($query) {
                $query->where('name', 'SENAEMPRESA_EPP');
            })
            ->get();

        if (!$loan) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index')->with('error', trans('senaempresa::menu.Loan not found.'));
        }

        $data = [
            'title' => trans('senaempresa::menu.Edit Loan'),
            'loan' => $loan,
            'apprentices' => $apprentices,
            'inventories' => $inventories,
        ];

        return view('senaempresa::Company.loans.edit', $data);
    }

    public function updated(Request $request, $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index')->with('error', trans('senaempresa::menu.Loan not found.'));
        }
        $loan->apprentice_id = $request->input('apprentice_id');
        $loan->inventory_id = $request->input('inventory_id');
        $loan->start_datetime = $request->input('start_datetime');
        $loan->end_datetime = $request->input('end_datetime');
        $loan->save();

        return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index')->with('success', trans('senaempresa::menu.Loan updated successfully.'));
    }

    public function inventory(Request $request)
    {
        $inventories = Inventory::with(['Element.Category'])
            ->where('state', 'Disponible')
            ->whereHas('Element.Category', function ($query) {
                $query->where('name', 'SENAEMPRESA_EPP');
            })
            ->get();

        $data = [
            'title' => trans('senaempresa::menu.Inventory'),
            'inventories' => $inventories,
        ];

        return view('senaempresa::Company.loans.inventory', $data);
    }


    public function updateInventoryState(Request $request)
    {
        $inventoryId = $request->input('inventory_id');
        $inventoryState = $request->input('inventory_state');

        try {
            // Actualiza el estado en la base de datos
            $inventory = Inventory::find($inventoryId);
            $inventory->state = $inventoryState;
            $inventory->save();

            return response()->json(['success' => true, 'message' => 'Estado actualizado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar el estado']);
        }
    }

    public function generateInventoryPDF(Request $request)
    {
        // Obtener los datos del inventario
        $inventories = Inventory::with(['Element.Category'])
            ->where('state', 'Disponible')
            ->whereHas('Element.Category', function ($query) {
                $query->where('name', 'SENAEMPRESA_EPP');
            })
            ->get();

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Establecer el título del documento con la fecha y hora actual en formato 12 horas
        $title = trans('senaempresa::menu.Inventory Report') . ' - ' . date('Y-m-d h:i:s A');
        $pdf->SetTitle($title);

        // Definir la fuente y el tamaño para el contenido del PDF
        $pdf->SetFont('helvetica', '', 10);

        // Agregar una nueva página
        $pdf->AddPage();

        $tableStyle = 'border-collapse: collapse; width: 100%; margin: auto; text-align: center;';
        $cellStyle = 'border: 1px solid #000; text-align: center; padding: 0 auto 8px; width: 267px; height: 14px; ';


        // Agregar el logo en la parte izquierda superior
        $logoPath = public_path('AdminLTE/dist/img/logo P SENA.png'); // Reemplaza con la ruta de tu logo
        $pdf->Image($logoPath, 176, 10, 22, '', 'PNG');

        // Método Header para establecer el contenido centrado del encabezado
        $pdf->SetY(15); // Ajustar la posición vertical del texto del encabezado
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 1, 'C');

        // Establecer el contenido del PDF
        $html = '<h4 style="text-align: center;">SENAEMPRESA</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';
        $html .= '<table style="' . $tableStyle . '">';
        $html .= '<tbody>';

        foreach ($inventories as $inventory) {

            $html .= '<tr><td colspan="2" style="height: 10px;"></td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>ID:</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->id . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Responsible') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->person->full_name . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Production unit') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->productive_unit_warehouse->productive_unit->name . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Warehouse') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->productive_unit_warehouse->warehouse->name . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Element') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->element->name . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Destination') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->destination . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Description') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->description . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Price') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->price . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Amount') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->amount . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Stock') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->stock . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Production date') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->production_date . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Lot number') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->lot_number . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Expiration_date') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->expiration_date . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.State') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->state . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Mark') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->mark . '</td></tr>';
            $html .= '<tr><td style="' . $cellStyle . '"><strong>' . trans('senaempresa::menu.Inventory code') . ':</strong></td>';
            $html .= '<td style="' . $cellStyle . '">' . $inventory->inventory_code . '</td></tr>';
            $html .= '<br>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C');



        // Generar el PDF y devolverlo para su descarga con la fecha en el nombre del archivo
        $filename = trans('senaempresa::menu.SENAEmpresa_inventory_report') . date('Ymd') . '.pdf';
        $pdf->Output($filename, 'I');
    }
}

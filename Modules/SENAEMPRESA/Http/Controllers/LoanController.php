<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Modules\SENAEMPRESA\Entities\Loan;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SICA\Entities\Inventory;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loanState = $request->input('loan_state');

        $loans = Loan::when($loanState, function ($query) use ($loanState) {
            return $query->where('state', $loanState);
        })->get();

        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $inventories = Inventory::with('Element')
            ->where('state', 'Disponible')
            ->get();

        $data = [
            'title' => 'Prestamos Registrados',
            'loans' => $loans,
            'staff_senaempresas' => $staff_senaempresas,
            'inventories' => $inventories,
        ];

        return view('senaempresa::Company.Loan.loan', $data);
    }

    public function devolver_prestamo($id)
    {
        // Busca el préstamo por su ID
        $loan = Loan::find($id);

        if ($loan) {
            // Actualiza el estado a "Devuelto"
            $loan->state = 'Devuelto';
            $loan->save();

            // Aumenta la cantidad en el inventario
            $inventory = Inventory::find($loan->inventory_id);
            if ($inventory) {
                $inventory->amount += 1;
                $inventory->save();
            }

            return redirect()->route('company.loan.prestamos')->with('success', trans('senaempresa::menu.Loan successfully repaid.'));
        } else {
            return redirect()->route('company.loan.prestamos')->with('error', trans('senaempresa::menu.The loan was not found.'));
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function register()
    {
        $loans = Loan::get();
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        // Filtra los inventarios con estado "Disponible"
        $inventories = Inventory::with('Element')
            ->where('state', 'Disponible')
            ->get();
        $data = [
            'title' => 'Prestamos Registrados',
            'loans' => $loans,
            'staff_senaempresas' => $staff_senaempresas,
            'inventories' => $inventories,
        ];
        return view('senaempresa::Company.Loan.new_loan', $data);
    }
    public function prestamo_nuevo(Request $request)
    {
        $inventory = Inventory::find($request->input('inventory_id'));

        // Verificar si el inventario existe y la cantidad es suficiente
        if ($inventory && $inventory->amount >= 1) {
            $loan = new Loan();
            $loan->staff_senaempresa_id = $request->input('staff_senaempresa_id');
            $loan->inventory_id = $request->input('inventory_id');
            $loan->start_datetime = $request->input('start_datetime');
            $loan->end_datetime = $request->input('end_datetime');
            $loan->state = 'Prestado';

            if ($loan->save()) {
                // Actualizar la cantidad en el inventario
                $inventory->amount -= 1;
                $inventory->save();

                // Indicar que se debe mostrar el formulario después de redirigir
                return redirect()->route('company.loan.prestamos')->with('showForm', true)->with('success', trans('senaempresa::menu.Loan added successfully.'));
            }
        } else {
            // La cantidad en el inventario no es suficiente
            return redirect()->route('company.loan.prestamos')->with('error', trans('senaempresa::menu.There is not enough in the inventory to make the loan.'));
        }
    }
    public function editar($id)
    {
        $loan = Loan::find($id);
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $inventories = Inventory::with('Element')->where('state', 'Disponible')->get();

        if (!$loan) {
            return redirect()->route('company.loan.prestamos')->with('error', trans('senaempresa::menu.Loan not found.'));
        }

        $data = [
            'title' => 'Edit Loan',
            'loan' => $loan,
            'staff_senaempresas' => $staff_senaempresas,
            'inventories' => $inventories,
        ];

        return view('senaempresa::Company.Loan.edit_loan', $data);
    }
    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return redirect()->route('company.loan.prestamos')->with('error', trans('senaempresa::menu.Loan not found.'));
        }
        $loan->staff_senaempresa_id = $request->input('staff_senaempresa_id');
        $loan->inventory_id = $request->input('inventory_id');
        $loan->start_datetime = $request->input('start_datetime');
        $loan->end_datetime = $request->input('end_datetime');
        $loan->save();

        return redirect()->route('company.loan.prestamos')->with('success', trans('senaempresa::menu.Loan updated successfully.'));
    }
}

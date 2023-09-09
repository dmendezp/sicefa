<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\SENAEMPRESA\Entities\Loan;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SICA\Entities\Inventory;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function new()
    {
        $data = ['title' => 'Nuevo'];
        return view('senaempresa::Company.Loan.new', $data);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function register()
    {
        $loans = Loan::get();
        $staff_senaempresas = StaffSenaempresa::with('Apprentice.Person')->get();
        $inventories = Inventory::with('Element')->get();
        $data = ['title' => 'Prestamos Registrados', 'loans' => $loans, 'staff_senaempresas' => $staff_senaempresas, 'inventories' => $inventories];
        return view('senaempresa::Company.Loan.loan', $data);
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


                return redirect()->route('cefa.prestamos')->with('success', trans('senaempresa::menu.Loan added successfully.'));
            }
        } else {
            // La cantidad en el inventario no es suficiente
            return redirect()->route('cefa.prestamos')->with('error', trans('senaempresa::menu.There is not enough in the inventory to make the loan.'));
        }
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

            return redirect()->route('cefa.prestamos')->with('success', trans('senaempresa::menu.Loan successfully repaid.'));
        } else {
            return redirect()->route('cefa.prestamos')->with('error', trans('senaempresa::menu.The loan was not found.'));
        }
    }
}

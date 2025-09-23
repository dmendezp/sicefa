<?php

namespace Modules\GDMF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GDMF\Entities\AnnualBudget;

class AnnualBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $budgets = AnnualBudget::orderBy('year', 'desc')->get();
        return view('gdmf::annual_budget.index')->with([
            'titlePage' => trans('Presupuesto Anual'),
            'titleView' => trans('Presupuesto Anual'),
            'budgets' => $budgets
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|unique:annual_budgets,year',
            'budget_total' => 'required|numeric|min:0',
        ]);

        AnnualBudget::create([
            'year' => $request->year,
            'budget_total' => $request->budget_total,
            'budget_current' => $request->budget_total,
        ]);

        return redirect()->back()->with('success', 'Presupuesto creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $budget = AnnualBudget::findOrFail($id);

        $request->validate([
            'budget_total' => 'required|numeric|min:0',
        ]);

        $budget->update([
            'budget_total' => $request->budget_total,
            'budget_current' => $request->budget_total, // Puedes ajustar si no deseas reiniciar
        ]);

        return redirect()->back()->with('success', 'Presupuesto actualizado.');
    }

    public function destroy($id)
    {
        AnnualBudget::destroy($id);
        return redirect()->back()->with('success', 'Presupuesto eliminado.');
    }
}

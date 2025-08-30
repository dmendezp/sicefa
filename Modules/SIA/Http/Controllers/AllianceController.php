<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\Alliance;
use Auth;

class AllianceController extends Controller
{

    public function index()
    {
        $view = ['titlePage' => 'Gestion de Alianzas', 'titleView' => 'Gestion de Alianzas'];
        $alliances = Alliance::latest()->get();
        return view('sia::alliance.index', compact('alliances', 'view'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'organization' => 'required',
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        Alliance::create($request->all());

        return redirect()->back()->with('success', 'Alianza creada correctamente.');
    }

    public function update(Request $request, $alliance)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'organization' => 'required',
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);
        $alliance = Alliance::find($alliance);
        $alliance->update($request->all());

        return redirect()->back()->with('success', 'Alianza actualizada correctamente.');
    }

    public function destroy($alliance)
    {
        $alliance = Alliance::find($alliance);
        $alliance->delete();
        return redirect()->back()->with('success', 'Alianza eliminada correctamente.');
    }
}

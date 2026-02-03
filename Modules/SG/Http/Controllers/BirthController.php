<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SG\Entities\Birth;
use Modules\SG\Entities\Animal;

class BirthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        $animalId = $request->get('animal_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $births = Birth::with(['mother', 'bull', 'calf'])
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($dateFrom, fn($q) => $q->whereDate('birth_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('birth_date', '<=', $dateTo))
            ->orderBy('birth_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::females()->orderBy('id')->get();

        return view('sg::admin.nacimientos.index', compact('births', 'animals', 'animalId', 'dateFrom', 'dateTo'));
    }

    public function indexliderDeUnidad(Request $request)
    {
        $animalId = $request->get('animal_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $births = Birth::with(['mother', 'bull', 'calf'])
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($dateFrom, fn($q) => $q->whereDate('birth_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('birth_date', '<=', $dateTo))
            ->orderBy('birth_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::females()->orderBy('id')->get();

        return view('sg::liderDeUnidad.births.index', compact('births', 'animals', 'animalId', 'dateFrom', 'dateTo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        $newCalves = Animal::whereNull('birth_date')->orderBy('id')->get();
        return view('sg::admin.nacimientos.create', compact('animals', 'bulls', 'newCalves'));
    }

    public function createliderDeUnidad()
    {
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        $newCalves = Animal::whereNull('birth_date')->orderBy('id')->get();
        return view('sg::liderDeUnidad.births.create', compact('animals', 'bulls', 'newCalves'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'insemination_date'   => 'nullable|date',
            'bull_id'             => 'nullable|exists:animals,id',
            'palpation_date'      => 'nullable|date',
            'gestation_days'      => 'nullable|integer|min:260|max:300',
            'diagnosis_note'      => 'nullable|string|max:100',
            'expected_birth_date' => 'nullable|date',
            'birth_date'          => 'required|date',
            'calf_sex'            => 'required|in:MALE,FEMALE',
            'calf_id'             => 'nullable|exists:animals,id',
            'observations'        => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Si hay calf_id, verificamos que sea nuevo
            if ($request->calf_id) {
                $calf = Animal::find($request->calf_id);
                if (!$calf) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'El animal no existe']);
                }
                if ($calf->birth_date) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'Este animal ya está registrado como cría de otro parto']);
                }
                // Actualizar el calf con su fecha de nacimiento
                $calf->update([
                    'birth_date' => $validated['birth_date'],
                    'sex' => $validated['calf_sex']
                ]);
            }

            // Crear el registro de nacimiento
            Birth::create($validated);

            DB::commit();

            return redirect()->route('sg.admin.sg.nacimientos.index')->with('success', 'Parto registrado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Error al guardar el registro: ' . $e->getMessage()]);
        }
    }

    public function storeliderDeUnidad(Request $request)
    {
        $validated = $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'insemination_date'   => 'nullable|date',
            'bull_id'             => 'nullable|exists:animals,id',
            'palpation_date'      => 'nullable|date',
            'gestation_days'      => 'nullable|integer|min:260|max:300',
            'diagnosis_note'      => 'nullable|string|max:100',
            'expected_birth_date' => 'nullable|date',
            'birth_date'          => 'required|date',
            'calf_sex'            => 'required|in:MALE,FEMALE',
            'calf_id'             => 'nullable|exists:animals,id',
            'observations'        => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Si hay calf_id, verificamos que sea nuevo
            if ($request->calf_id) {
                $calf = Animal::find($request->calf_id);
                if (!$calf) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'El animal no existe']);
                }
                if ($calf->birth_date) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'Este animal ya está registrado como cría de otro parto']);
                }
                // Actualizar el calf con su fecha de nacimiento
                $calf->update([
                    'birth_date' => $validated['birth_date'],
                    'sex' => $validated['calf_sex']
                ]);
            }

            // Crear el registro de nacimiento
            Birth::create($validated);

            DB::commit();

            return redirect()->route('sg.liderDeUnidad.sg.births.index')->with('success', 'Parto registrado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Error al guardar el registro: ' . $e->getMessage()]);
        }
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $birth = Birth::with(['mother', 'bull', 'calf'])->findOrFail($id);
        return view('sg::admin.nacimientos.show', compact('birth'));
    }

    public function showliderDeUnidad($id)
    {
        $birth = Birth::with(['mother', 'bull', 'calf'])->findOrFail($id);
        return view('sg::liderDeUnidad.births.show', compact('birth'));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    
    public function edit($id)
    {
        $birth = Birth::findOrFail($id);
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        $newCalves = Animal::whereNull('birth_date')->orderBy('id')->get();
        return view('sg::admin.nacimientos.edit', compact('birth', 'animals', 'bulls', 'newCalves'));
    }

    public function editliderDeUnidad($id)
    {
        $birth = Birth::findOrFail($id);
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        $newCalves = Animal::whereNull('birth_date')->orderBy('id')->get();
        return view('sg::liderDeUnidad.births.edit', compact('birth', 'animals', 'bulls', 'newCalves'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $birth = Birth::findOrFail($id);

        $validated = $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'insemination_date'   => 'nullable|date',
            'bull_id'             => 'nullable|exists:animals,id',
            'palpation_date'      => 'nullable|date',
            'gestation_days'      => 'nullable|integer|min:260|max:300',
            'diagnosis_note'      => 'nullable|string|max:100',
            'expected_birth_date' => 'nullable|date',
            'birth_date'          => 'required|date',
            'calf_sex'            => 'required|in:MALE,FEMALE',
            'calf_id'             => 'nullable|exists:animals,id',
            'observations'        => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Si existe un calf_id anterior, limpiamos su birth_date
            if ($birth->calf_id && $birth->calf_id != $request->calf_id) {
                $oldCalf = Animal::find($birth->calf_id);
                if ($oldCalf) {
                    $oldCalf->update([
                        'birth_date' => null,
                        'sex' => null
                    ]);
                }
            }

            // Si hay nuevo calf_id, lo actualizamos
            if ($request->calf_id) {
                $calf = Animal::find($request->calf_id);
                if (!$calf) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'El animal no existe']);
                }
                // Verificar que no sea cría de otro parto (a menos que sea el mismo)
                if ($calf->birth_date && $calf->id != $birth->calf_id) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'Este animal ya está registrado como cría de otro parto']);
                }
                // Actualizar el calf con su fecha de nacimiento
                $calf->update([
                    'birth_date' => $validated['birth_date'],
                    'sex' => $validated['calf_sex']
                ]);
            }

            // Actualizar el registro de nacimiento
            $birth->update($validated);

            DB::commit();

            return redirect()->route('sg.admin.sg.nacimientos.index')->with('success', 'Parto actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Error al actualizar el registro: ' . $e->getMessage()]);
        }
    }

    public function updateliderDeUnidad(Request $request, $id)
    {
        $birth = Birth::findOrFail($id);

        $validated = $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'insemination_date'   => 'nullable|date',
            'bull_id'             => 'nullable|exists:animals,id',
            'palpation_date'      => 'nullable|date',
            'gestation_days'      => 'nullable|integer|min:260|max:300',
            'diagnosis_note'      => 'nullable|string|max:100',
            'expected_birth_date' => 'nullable|date',
            'birth_date'          => 'required|date',
            'calf_sex'            => 'required|in:MALE,FEMALE',
            'calf_id'             => 'nullable|exists:animals,id',
            'observations'        => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Si existe un calf_id anterior, limpiamos su birth_date
            if ($birth->calf_id && $birth->calf_id != $request->calf_id) {
                $oldCalf = Animal::find($birth->calf_id);
                if ($oldCalf) {
                    $oldCalf->update([
                        'birth_date' => null,
                        'sex' => null
                    ]);
                }
            }

            // Si hay nuevo calf_id, lo actualizamos
            if ($request->calf_id) {
                $calf = Animal::find($request->calf_id);
                if (!$calf) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'El animal no existe']);
                }
                // Verificar que no sea cría de otro parto (a menos que sea el mismo)
                if ($calf->birth_date && $calf->id != $birth->calf_id) {
                    DB::rollBack();
                    return back()->withErrors(['calf_id' => 'Este animal ya está registrado como cría de otro parto']);
                }
                // Actualizar el calf con su fecha de nacimiento
                $calf->update([
                    'birth_date' => $validated['birth_date'],
                    'sex' => $validated['calf_sex']
                ]);
            }

            // Actualizar el registro de nacimiento
            $birth->update($validated);

            DB::commit();

            return redirect()->route('sg.liderDeUnidad.sg.births.index')->with('success', 'Parto actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Error al actualizar el registro: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $birth = Birth::findOrFail($id);

        try {
            DB::beginTransaction();

            // Si existe un calf_id, limpiamos su birth_date y sex
            if ($birth->calf_id) {
                $calf = Animal::find($birth->calf_id);
                if ($calf) {
                    $calf->update([
                        'birth_date' => null,
                        'sex' => null
                    ]);
                }
            }

            // Eliminar el registro de nacimiento
            $birth->delete();

            DB::commit();

            return redirect()->route('sg.admin.sg.nacimientos.index')->with('success', 'Parto eliminado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Error al eliminar el registro: ' . $e->getMessage()]);
        }
    }

    public function destroyliderDeUnidad($id)
    {
        $birth = Birth::findOrFail($id);

        try {
            DB::beginTransaction();

            // Si existe un calf_id, limpiamos su birth_date y sex
            if ($birth->calf_id) {
                $calf = Animal::find($birth->calf_id);
                if ($calf) {
                    $calf->update([
                        'birth_date' => null,
                        'sex' => null
                    ]);
                }
            }

            // Eliminar el registro de nacimiento
            $birth->delete();

            DB::commit();

            return redirect()->route('sg.liderDeUnidad.sg.births.index')->with('success', 'Parto eliminado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Error al eliminar el registro: ' . $e->getMessage()]);
        }
    }
}
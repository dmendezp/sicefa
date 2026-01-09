<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\Breed;
use Modules\SG\Entities\Animal;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // public function index()
    // {
    //     return view('sg::index');
    // }

    public function index()
    {
        $animals = Animal::with('breed')->orderBy('id', 'desc')->paginate(12);
        return view('sg::admin.animales.index', compact('animals'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    // public function create()
    // {
    //     return view('sg::create');
    // }

    public function create()
    {
        $breeds = Breed::orderBy('name')->pluck('name', 'id');
        return view('sg::admin.animales.create', compact('breeds'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'nullable|string|max:100',
            'breed_id'       => 'required|exists:breeds,id',
            'sex'            => 'required|in:MALE,FEMALE',
            'birth_date'     => 'required|date|before_or_equal:today',
            'entry_date'     => 'nullable|date',
            'weight_kg'      => 'nullable|numeric|min:0',
            'production_stage' => 'required|in:CALF,GROWING,DRY,MILKING,CULL',
            'age_group'      => 'nullable|string|max:50',
            'inventory_value' => 'nullable|numeric|min:0',
            'lot'            => 'nullable|string|max:50',
            'note'           => 'nullable|string',
            'body_condition' => 'nullable|string|max:50',
            'observations'   => 'nullable|string',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Generar ID automático (ej: V0001, T0002)
        $prefix = $request->input('sex') === 'FEMALE' ? 'V' : 'T';
        $number = 1;
        do {
            $animalId = $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
            $number++;
        } while (Animal::where('id', $animalId)->exists());

        $data = $request->except(['photo']);
        $data['id'] = $animalId;

        // Subida de foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('animals', 'public');
            $data['photo_path'] = $path;
        }

        Animal::create($data);

        return redirect()->route('sg.admin.sg.animales.index')->with('success', "Bovino {$animalId} registrado exitosamente");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function show($id)
    // {
    //     return view('sg::show');
    // }

    public function show($id)
    {
        $animal = Animal::with('breed')->findOrFail($id);
        return view('sg::admin.animales.show', compact('animal'));
    }

    // public function show(Animal $animal)
    // {
    //     $animal->load(['breed', 'healthRecords', 'milkProductions', 'inseminations', 'births', 'weightRecords']);
    //     return view('sg::admin.animales.show', compact('animal'));
    // }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function edit($id)
    // {
    //     return view('sg::edit');
    // }

    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        $breeds = Breed::orderBy('name')->pluck('name', 'id');
        return view('sg::admin.animales.edit', compact('animal', 'breeds'));
    }

    // public function edit(Animal $animal)
    // {
    //     $breeds = Breed::orderBy('name')->pluck('name', 'id');
    //     return view('animals.edit', compact('animal', 'breeds'));
    // }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $request->validate([
            'name'           => 'nullable|string|max:100',
            'breed_id'       => 'required|exists:breeds,id',
            'sex'            => 'required|in:MALE,FEMALE',
            'birth_date'     => 'required|date|before_or_equal:today',
            'entry_date'     => 'nullable|date',
            'weight_kg'      => 'nullable|numeric|min:0',
            'production_stage' => 'required|in:CALF,GROWING,DRY,MILKING,CULL',
            'age_group'      => 'nullable|string|max:50',
            'inventory_value' => 'nullable|numeric|min:0',
            'lot'            => 'nullable|string|max:50',
            'note'           => 'nullable|string',
            'body_condition' => 'nullable|string|max:50',
            'observations'   => 'nullable|string',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            if ($animal->photo_path) {
                Storage::disk('public')->delete($animal->photo_path);
            }
            $photo_path = $request->file('photo')->store('animals', 'public');
        } else {
            $photo_path = $animal->photo_path;
        }

        $data = [
            'name'           => $request->input('name'),
            'breed_id'       => $request->input('breed_id'),
            'sex'            => $request->input('sex'),
            'birth_date'     => $request->input('birth_date'),
            'entry_date'     => $request->input('entry_date'),
            'weight_kg'      => $request->input('weight_kg'),
            'production_stage' => $request->input('production_stage'),
            'age_group'      => $request->input('age_group'),
            'inventory_value' => $request->input('inventory_value'),
            'lot'            => $request->input('lot'),
            'note'           => $request->input('note'),
            'body_condition' => $request->input('body_condition'),
            'observations'   => $request->input('observations'),
            'photo_path'     => $photo_path
        ];

        $animal->update($data);

        return redirect()->route('sg.admin.sg.animales.index')->with('success', "Bovino {$animal->id} actualizado correctamente");
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        if ($animal->photo_path) {
            Storage::disk('public')->delete($animal->photo_path);
        }
        $animal->delete();
        return redirect()->route('sg.admin.sg.animales.index')->with('success', "Bovino {$animal->id} eliminado correctamente");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fertilizer;

class FertilizersController extends Controller
{
    protected $fertilizers; // Declaración de la variable protegida

    public function __construct()
    {
        // Carga los fertilizantes en la variable protegida en el constructor
        $this->fertilizers = Fertilizer::all();
    }

    public function index()
    {
        $fertilizers = Fertilizer::all();
        return view('fertilizers.index', ['fertilizers' => $this->fertilizers]);
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'producto' => 'required|string|max:255',
            'dosis' => 'required|string',
            'cantidad_total' => 'required|string',
            'costo_total' => 'required|string',
            'metodo_de_aplicacion' => 'required|string',
            'registro_ica' => 'required|string',
            'lote' => 'required|string',
        ]);

        // Crea un nuevo fertilizante en la base de datos
        Fertilizer::create($validatedData);

        // Redirige de nuevo a la lista de fertilizantes con un mensaje de éxito
        return redirect()->route('fertilizers.index')->with('success', 'Fertilizante creado con éxito');
    }

    public function edit(Fertilizer $fertilizer)
    {
        return view('fertilizers.edit', compact('fertilizer'));
    }

    public function update(Request $request, Fertilizer $fertilizer)
    {
        try {
            // Valida los datos del formulario
            $validatedData = $request->validate([
                'producto' => 'required|string|max:255',
                'dosis' => 'required|string',
                'cantidad_total' => 'required|string',
                'costo_total' => 'required|string',
                'metodo_de_aplicacion' => 'required|string',
                'registro_ica' => 'required|string',
                'lote' => 'required|string',
            ]);

            // Actualiza los atributos del fertilizante con los datos validados
            $fertilizer->update($validatedData);

            // Redirige de nuevo a la lista de fertilizantes con un mensaje de éxito
            return redirect()->route('fertilizers.index')->with('success', 'Fertilizante actualizado con éxito');
        } catch (\Exception $e) {
            // Maneja cualquier excepción que pueda ocurrir, por ejemplo, si los datos no son válidos o la actualización falla
            return redirect()->route('fertilizers.edit', $fertilizer->id)->with('error', 'Error al actualizar el fertilizante');
        }
    }

    public function destroy(Fertilizer $fertilizer)
    {
        try {
            // Elimina el fertilizante
            $fertilizer->delete();

            // Redirige de nuevo a la lista de fertilizantes con un mensaje de éxito
            return redirect()->route('fertilizers.index')->with('success', 'Fertilizante eliminado con éxito');
        } catch (\Exception $e) {
            // Maneja cualquier excepción que pueda ocurrir, por ejemplo, si el fertilizante no se puede eliminar
            return redirect()->route('fertilizers.index')->with('error', 'Error al eliminar el fertilizante');
        }
    }
}


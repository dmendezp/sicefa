<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Position;

class PositionsController extends Controller
{

    //Funcion mostrar vista posicion
    public function viewpositions()
    {
        $positions = Position::all();
        return view('gth::position.position', compact('positions'));
    }


    public function postcreatepositions(Request $request)
    {
        $positions = new Position;
        $positions->name = $request->input('name');
        $positions->description = $request->input('description');
        $positions->save();

        return redirect()->route('gth.positions');
    }


    public function updatepositions(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255', // Agrega más reglas según tus necesidades
            // Agrega más campos y reglas según tus necesidades
        ]);

        $positions = Position::findOrFail($id);

        // Actualizar los campos necesarios
        $positions->name = $request->input('name');
        $positions->description = $request->input('description');

        // Actualiza otros campos si es necesario

        $positions->save();

        // Redirigir a donde quieras después de la actualización
        return redirect()->route('gth.positions')->with('success', ' actualizado exitosamente de posicion.');
    }

    public function showPositions($id)
    {
        $positions = Position::find($id);
        return view('positions.positions', ['positions' => $positions]);
    }


    public function deletePositions($id)
    {
        try {
            $positions = position::findOrFail($id);
            $positions->delete();

            return redirect()->route('gth.positions')->with('success', 'ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('gth.positions')->with('error', 'No se pudo eliminar La Posicion.');
        }
    }
}

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
        $positions->professional_denomination = $request->input('professional_denomination');
        $positions->grade = $request->input('grade');
        $positions->save();

        return redirect()->route('gth.admin.position.index');
    }


    public function updatepositions(Request $request, $id)
    {
        $positions = Position::findOrFail($id);
        // Actualizar los campos necesarios
        $positions->professional_denomination = $request->input('professional_denomination');
        $positions->grade = $request->input('grade');

        // Actualiza otros campos si es necesario

        $positions->save();

        // Redirigir a donde quieras después de la actualización
        return redirect()->route('gth.admin.position.index')->with('success',trans('gth::menu.Position successfully updated.'));
    }

    public function showPositions($id)
    {
        $positions = Position::find($id);
        return view('positions.position', ['positions' => $positions]);
    }


    public function deletePositions($id)
    {
        try {
            $positions = position::findOrFail($id);
            $positions->delete();

            return redirect()->route('gth.admin.position.index')->with('success', trans('gth::menu.Has been successfully deleted'));
        } catch (\Exception $e) {
            return redirect()->route('gth.admin.position.index')->with('error', trans('gth::menu.The Position could not be deleted.'));
        }
    }
}

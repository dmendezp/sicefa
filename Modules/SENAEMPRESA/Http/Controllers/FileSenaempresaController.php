<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\FileSenaempresa;
use Modules\SENAEMPRESA\Entities\postulate;

class FileSenaempresaController extends Controller
{
    public function score($apprenticeId)
    {
        // Buscar el postulado por apprentice_id
        $postulate = postulate::where('apprentice_id', $apprenticeId)->first();

        // Comprobar si se encontró un postulado
        if (!$postulate) {
            return redirect()->back()->with('error', 'No se encontró un postulado con el ID proporcionado.');
        }

        $data = ['title' => 'Asignar Puntaje', 'postulate' => $postulate];

        return view('senaempresa::Company.Postulate.score', $data);
    }

    public function assignScore(Request $request)
    { // Validar el formulario si es necesario
        $request->validate([
            'postulate_id' => 'required',
            'cv_score' => 'required|integer',
            'personalities_score' => 'required|integer',
            'proposal_score' => 'required|integer',
        ]);

        $filesenaempresa = new FileSenaempresa();
        $filesenaempresa->postulate_id = $request->input('postulate_id');
        $filesenaempresa->cv_score = $request->input('cv_score');
        $filesenaempresa->personalities_score = $request->input('personalities_score');
        $filesenaempresa->proposal_score = $request->input('proposal_score');

        // Guardar el objeto en la base de datos
        $filesenaempresa->save();

        // Puedes redirigir a la página que desees después de guardar los datos
        return redirect()->route('company.postulate')->with('success', 'Puntaje asignado correctamente');
    
    }
}

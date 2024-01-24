<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Program;
use Modules\DICSENA\Entities\Guidepost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response; // Asegúrate de tener esta importación

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $vista = "vista-2";
        $programs = Program::orderBy('name', 'asc')->get();

        $selectedProgram = $request->input('program_name');

        if ($selectedProgram) {
            $guideposts = Guidepost::query();
            $guideposts->whereHas('program', function ($query) use ($selectedProgram) {
                $query->where('name', 'like', "%$selectedProgram");
            });
            $guideposts = $guideposts->orderBy('created_at', 'asc')->get();
        } else {
            $guideposts = collect([]);
        }

        return view('dicsena::guide', compact('guideposts', 'programs', 'selectedProgram', 'vista'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dicsena::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Lógica de almacenamiento
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dicsena::edit');
    }
    public function download($id)
    {
        $guidepost = Guidepost::findOrFail($id);
        $filePath = storage_path('app/public/guideposts_file/' . $guidepost->url);

        if (File::exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            return response()->download($filePath, $guidepost->url, $headers);
        } else {
            // Manejar el caso donde el archivo no existe
            return response()->json(['error' => 'El archivo no existe'], 404);
        }
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Lógica de actualización
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // Lógica de eliminación
    }
}

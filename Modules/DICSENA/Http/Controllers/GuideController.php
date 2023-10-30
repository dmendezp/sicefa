<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Program;
use Modules\DICSENA\Entities\Guidepost;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $vista = "vista-2";
        $programs = Program::orderBy('name', 'asc')->get(); // Ordenar programas por nombre en orden alfabético
        $selectedProgram = $request->input('program_name');

        if ($selectedProgram) {
            $guideposts = Guidepost::query();
            $guideposts->whereHas('program', function ($query) use ($selectedProgram) {
                $query->where('name', 'like', "%$selectedProgram");
            });
            $guideposts = $guideposts->orderBy('created_at', 'asc')->get(); // Ordenar guías por fecha de creación en orden ascendente
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
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dicsena::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dicsena::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

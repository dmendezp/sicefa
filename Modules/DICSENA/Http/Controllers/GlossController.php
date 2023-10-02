<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\DICSENA\Entities\Glossary;

class GlossController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('dicsena::gloss');
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
    public function search(Request $request)
    {
        $search = $request->input('search');
        $glossaries = Glossary::where('word', 'like', "%$search%")
            ->orWhere('traduction', 'like', "%$search%")
            ->orWhere('meaning', 'like', "%$search%")
            ->orWhereHas('program', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orderBy('word')
            ->paginate(10);

        return view('dicsena::gloss', compact('glossaries'));
    }
}

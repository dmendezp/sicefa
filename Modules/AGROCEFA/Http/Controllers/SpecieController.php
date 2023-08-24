<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie; 


class SpecieController extends Controller
{
    public function index()
    {
        $species= Specie::all();
        return view('agrocefa::species.index', compact('species'));
    }

    public function editView($id)
    {
        $specie = Specie::findOrFail($id);
        return view('agrocefa::species.edit', compact('specie'));
    }
    
    public function deleteView($id)
    {
        $specie = Specie::findOrFail($id);
        return view('agrocefa::species.delete', compact('specie'));
    }

    public function create()
    {
        return view('agrocefa::species.create');
    }
    

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('agrocefa::show');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

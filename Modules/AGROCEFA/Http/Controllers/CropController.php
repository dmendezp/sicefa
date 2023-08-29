<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Crop; // Asegúrate de importar el modelo Crop y otros namespaces necesarios

class CropController extends Controller
{
    public function index()
    {
        $crop= Crop::all();
        return view('agrocefa::crop.index', compact('crop'));
    }
    
    public function create()
    {
        return view('agrocefa::crop.create');
    }
    public function delete($id)
    {
        $crop = Crop::findOrFail($id);
        return view('crop.delete', compact('crop'));
    }

    public function edit($id)
    {
        $crop = Crop::findOrFail($id);
        return view('crop.edit', compact('crop'));
    }

}

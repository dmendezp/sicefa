<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Validator;
use Illuminate\Support\Facades\Storage;


class ElementController extends Controller
{
    public function index()
    {
        $element = Element::all();
        $titleView = 'Administración de imagenes de productos generales';
        $view = ['titlePage' => 'Imagenes de roductos'];
        return view('ptventa::element.index', compact('element','titleView','view'));
    }

    public function edit(Element $element)
    {
        $titleView = 'Actualización imagenes de productos generales';
        $view = ['titlePage' => 'Actualizar | Imagen de Producto'];
        return view('ptventa::element.edit', compact('element','titleView','view'));
    }

    public function update(Request $request, $element)
    {
        //Obtener la imagen enviada por el usuario
        $image = $request->file('image');
    
        //Eliminar la imagen anterior del sistema de archivos
        $previousImage = Element::find($element)->image;
        Storage::delete($previousImage);
    
        //Guardar la nueva imagen en el sistema de archivos
        $newImagePath = $image->store('public/image');
    
        //Actualizar la ruta de la imagen en la base de datos
        $image = Element::find($element);
        $image->image = $newImagePath;
        $image->save();
    
        return redirect()->route('ptventa::element.index');
    }
}

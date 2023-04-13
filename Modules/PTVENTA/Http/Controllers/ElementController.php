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
        $titleView = 'Actualizar imagen de producto';
        $view = ['titlePage' => 'Actualizar | Imagen de Producto'];
        return view('ptventa::element.edit', compact('element','titleView','view'));
    }

    public function update(Request $request, Element $element)
    {
        if($request->hasFile('image')){ // Verificar si se ha subido una nueva imagen
            //Obtener la imagen enviada por el usuario
            $image = $request->file('image');

            //Eliminar la imagen anterior del sistema de archivos
            unlink(public_path($element->image));

            //Guardar la nueva imagen en el sistema de archivos
            $extension =  pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION); // Capturar la extensión de la nueva imagen
            $name_image =  $element->slug . '.' . $extension; // Generar el nombre por defecto de la nueva imagen
            $image->move(public_path('modules/sica/images/elements/'), $name_image); // Guarda la imagen dentro de public

            //Actualizar la ruta de la imagen en la base de datos
            $element->image = 'modules/sica/images/elements/' . $name_image; // Generar ruta relativa de la nueva imagen
            $element->save(); // Actualizar el registro del elemento con la nueva imagen cargada
        }

        return redirect()->route('ptventa.admin.element.index');
    }
}

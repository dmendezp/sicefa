<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Validator;


class ElementController extends Controller
{
    public function index()
    {
        $element = Element::all();
        $titleView = 'Administración de imagenes de productos generales';
        $view = ['titlePage' => 'Imagenes de productos'];
        return view('ptventa::element.index', compact('element','titleView','view'));
    }

    public function gallery()
    {
        $elements = Element::all();
        $titleView = 'Galería de imágenes de productos';
        $view = ['titlePage' => 'Galería de productos'];
        return view('ptventa::element.gallery', compact('elements','titleView','view'));
    }

    public function edit(Element $element)
    {
        $titleView = 'Actualizar imagen de producto';
        $view = ['titlePage' => 'Actualizar | Imagen de Producto'];
        return view('ptventa::element.edit', compact('element','titleView','view'));
    }

    public function update(Request $request, Element $element)
    {

        $rules = [
            'image' => 'required',
        ];

        $messages = [
            'image.required' => 'La imagen es obligatoria',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withInput()->withErrors($validator)->with('message-validator','Se ha producido un error. Por favor, verifica el formulario.')->with('typealert','danger');
        else:
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
                  if ($element->save()){// Actualizar el registro del elemento con la nueva imagen cargada
                    $message_ptventa = "Imagen actualizada exitosamente";
                    $message_ptventa_type = 'success';
                  }else{
                    $message_ptventa = "Se ha producido un error en el momento de actualizar la imagen";
                    $message_ptventa_type = 'error';
                  }
                  return redirect(route('ptventa.admin.element.index'))->with('message_ptventa',$message_ptventa)->with('message_ptventa_type',$message_ptventa_type);
            }
       endif;
    }

    public function cropImageUploadAjax(Request $request)
    {
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);

         $saveFile = new CropImage;
         $saveFile->name = $imageName;
         $saveFile->save();

        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

}

<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\App;
use Validator;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $view = ['titlePage'=>'Productos', 'titleView'=>'Administracion de imágenes de productos'];
        $apps = App::get();
        return view('cafeto::element.index', compact('apps','view'));
    }

    public function edit(Element $element){ // Vista de formulario para actualizar imagen de elemento
        $view = ['titlePage'=>'Actualizar Productos', 'titleView'=>'Actualización de productos'];
        $apps = App::get();
        return view('cafeto::element.edit', compact('apps', 'view'));
    }

    public function update(Request $request, Element $element){ // Actualización de imagen de element
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
                if(file_exists(public_path($element->image) and $element->image <> null)){  // Valida que la imagen realmente existe en el almacenamiento
                    unlink(public_path($element->image));
                }

                //Guardar la nueva imagen en el sistema de archivos
                $extension =  pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION); // Capturar la extensión de la nueva imagen
                $name_image =  $element->slug . '.' . $extension; // Generar el nombre por defecto de la nueva imagen
                $image->move(public_path('modules/sica/images/elements/'), $name_image); // Guarda la imagen dentro de public

                //Actualizar la ruta de la imagen en la base de datos
                $element->image = 'modules/sica/images/elements/' . $name_image; // Generar ruta relativa de la nueva imagen
                  if ($element->save()){// Actualizar el registro del elemento con la nueva imagen cargada
                    $message_cafeto = "Imagen actualizada exitosamente";
                    $message_cafeto_type = 'success';
                  }else{
                    $message_cafeto = "Se ha producido un error en el momento de actualizar la imagen";
                    $message_cafeto_type = 'error';
                  }
                  return redirect(route('cafeto.element.index'))->with('message_cafeto',$message_cafeto)->with('message_cafeto_type',$message_cafeto_type);
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

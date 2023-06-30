<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;
use Validator;


class ElementController extends Controller
{
    public function index(){ // Vista de galería de imágenes
        $view = ['titlePage'=>'Productos - Galería de imágenes', 'titleView'=>'Administración de imágenes de productos'];
        return view('ptventa::element.index', compact('view'));
    }

    public function edit(Element $element){ // Vista de formulario para actualizar imagen de elemento
        $view = ['titlePage'=>'Productos - Actualizar imagen', 'titleView'=>'Actualizar imagen de producto'];
        return view('ptventa::element.edit', compact('element','view'));
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
                    $message_ptventa = "Imagen actualizada exitosamente";
                    $message_ptventa_type = 'success';
                  }else{
                    $message_ptventa = "Se ha producido un error en el momento de actualizar la imagen";
                    $message_ptventa_type = 'error';
                  }
                  return redirect(route('ptventa.element.image.index'))->with('message_ptventa',$message_ptventa)->with('message_ptventa_type',$message_ptventa_type);
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

    public function create()
    {
        $view = ['titlePage'=>'Productos - Crear Poducto', 'titleView'=>'Crear Nuevo Producto'];
        $measurement_units = MeasurementUnit::orderBy('name','ASC')->pluck('name','id');
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $kind_of_purchase = KindOfPurchase::orderBy('name','ASC')->pluck('name','id');
        return view('ptventa::element.create', compact('view', 'measurement_units', 'categories', 'kind_of_purchase'));
    }

    public function store(Request $request){
        $rules = [
            'image' => 'required',
            'name' => 'required',
            'measurement_unit_id' => 'required',
            'description' => 'required',
            'kind_of_purchase_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'UNSPSC_code' => 'required',
        ];

        $messages = [
            'image.required' => 'La imagen es obligatoria',
            'name.required' => 'El nombre del producto es obligatorio',
            'measurement_unit_id.required' => 'La unidad de medida es obligatoria',
            'description.required.required'=> 'La descripcion del producto es obligatoria',
            'kind_of_purchase_id.required' => 'El tipo de compra es obligatoria',
            'category_id.required' => 'Lacategoria es obligatoria',
            'price.required' => 'El precio del producto es obligatorio',
            'UNSPSC_code.required' => 'El codigo del producto es obligatorio',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withInput()->withErrors($validator)->with('message-validator','Se ha producido un error. Por favor, verifica el formulario.')->with('typealert','danger');
        else:
            $element = $request->all();

            $image = $request->file('image');
                $extension =  pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION); // Capturar la extensión de la nueva imagen
                $name_image =  $element->slug . '.' . $extension; // Generar el nombre por defecto de la nueva imagen
                $image->move(public_path('modules/sica/images/elements/'), $name_image);

            if( Element::create($element)){
                $message_ptventa_type = 'success';
                $message_ptventa = 'Producto agregado exitosamente.';
            }else{
                $message_ptventa_type = 'error';
                $message_ptventa = 'No se pudo agregar el producto.';
            }
            return redirect(route('ptventa.element.image.index'))->with('message_ptventa',$message_ptventa)->with('message_ptventa_type',$message_ptventa_type);
         endif;
    }

}

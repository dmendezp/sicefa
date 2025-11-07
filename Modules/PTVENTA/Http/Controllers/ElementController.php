<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;
use Illuminate\Support\Facades\Validator;

class ElementController extends Controller
{
    public function index(){ // Vista de galería de imágenes
        $view = ['titlePage'=> trans('ptventa::controllers.PTVENTA_element_index_title_page'), 'titleView'=> trans('ptventa::controllers.PTVENTA_element_index_title_view')];
        return view('ptventa::element.index', compact('view'));
    }

    public function create()
    {
        $view = ['titlePage'=> trans('ptventa::controllers.PTVENTA_element_create_title_page'), 'titleView'=> trans('ptventa::controllers.PTVENTA_element_create_title_view')];
        $measurement_units = MeasurementUnit::orderBy('name','ASC')->get();
        $categories = Category::orderBy('name','ASC')->get();
        $kind_of_purchases = KindOfPurchase::orderBy('name','ASC')->get();
        return view('ptventa::element.create', compact('view', 'measurement_units', 'categories', 'kind_of_purchases'));
    }

    public function store(Request $request){
        $request->merge(['price' => revertPriceFormat(e($request->input('price')))]); // Limpiar el valor de price
        $rules = [
            'name' => 'required|unique:elements',
            'measurement_unit_id' => 'required',
            'kind_of_purchase_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'UNSPSC_code' => 'nullable|integer|unique:elements'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Registro del elemento
        $element = new Element();
        $element->name = e($request->input('name'));
        if($request->hasFile('image')){ // Verificar si se ha subido una nueva imagen
            //Obtener la imagen enviada por el usuario
            $image = $request->file('image');
            //Guardar la nueva imagen en el sistema de archivos
            $extension =  pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION); // Capturar la extensión de la nueva imagen
            $name_image =  $element->slug . '.' . $extension; // Generar el nombre por defecto de la nueva imagen
            $image->move(public_path('modules/sica/images/elements/'), $name_image); // Guarda la imagen dentro de public
            //Actualizar la ruta de la imagen en la base de datos
            $element->image = 'modules/sica/images/elements/' . $name_image; // Generar ruta relativa de la nueva imagen
        }
        $element->measurement_unit_id = e($request->input('measurement_unit_id'));
        $element->description = e($request->input('description'));
        $element->kind_of_purchase_id = e($request->input('kind_of_purchase_id'));
        $element->category_id = e($request->input('category_id'));
        $element->price = e($request->input('price'));
        $UNSPSC_code = e($request->input('UNSPSC_code'));
        $element->UNSPSC_code = !empty($UNSPSC_code) ? $UNSPSC_code : null;
        if ($element->save()){
            $message_ptventa = "Elemento agregado exitosamente";
            $message_ptventa_type = 'success';
        }else{
            $message_ptventa = "Se ha producido un error en el momento de agregar el elemento";
            $message_ptventa_type = 'error';
        }
        return redirect(route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.element.index'))->with('message_ptventa', $message_ptventa)->with('message_ptventa_type', $message_ptventa_type);
    }

    public function edit(Element $element){ // Vista de formulario para actualizar imagen de elemento
        $measurement_units = MeasurementUnit::orderBy('name','ASC')->get();
        $categories = Category::orderBy('name','ASC')->get();
        $kind_of_purchases = KindOfPurchase::orderBy('name','ASC')->get();
        $view = ['titlePage'=>trans('ptventa::controllers.PTVENTA_element_edit_title_page'), 'titleView'=> trans('ptventa::controllers.PTVENTA_element_edit_title_view')];
        return view('ptventa::element.edit', compact('element', 'view', 'measurement_units', 'categories', 'kind_of_purchases'));
    }

    public function update(Request $request, Element $element){ // Actualización de imagen de element
        $request->merge(['price' => revertPriceFormat(e($request->input('price')))]); // Limpiar el valor de price
        $rules = [
            'name' => 'required|unique:elements,name,'.$element->id,
            'measurement_unit_id' => 'required',
            'kind_of_purchase_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'UNSPSC_code' => 'nullable|integer|unique:elements,UNSPSC_code,'.$element->id
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualización del elemento
        $element->name = e($request->input('name'));
        if($request->hasFile('image')){ // Verificar si se ha subido una nueva imagen
            //Obtener la imagen enviada por el usuario
            $image = $request->file('image');
            //Eliminar la imagen anterior del sistema de archivos
            if(file_exists(public_path($element->image))){  // Valida que la imagen realmente existe en el almacenamiento
                unlink(public_path($element->image));
            }
            //Guardar la nueva imagen en el sistema de archivos
            $extension =  pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION); // Capturar la extensión de la nueva imagen
            $image_name =  $element->slug . '.' . $extension; // Generar el nombre por defecto de la nueva imagen
            $image->move(public_path('modules/sica/images/elements/'), $image_name); // Guarda la imagen dentro de public
            //Actualizar la ruta de la imagen en la base de datos
            $element->image = 'modules/sica/images/elements/' . $image_name; // Generar ruta relativa de la nueva imagen
        }
        $element->measurement_unit_id = e($request->input('measurement_unit_id'));
        $element->description = e($request->input('description'));
        $element->kind_of_purchase_id = e($request->input('kind_of_purchase_id'));
        $element->category_id = e($request->input('category_id'));
        $element->price = e($request->input('price'));
        $UNSPSC_code = e($request->input('UNSPSC_code'));
        $element->UNSPSC_code = !empty($UNSPSC_code) ? $UNSPSC_code : null;
        if ($element->save()){// Actualizar el registro del elemento con la nueva imagen cargada
            $message_ptventa = "Imagen actualizada exitosamente";
            $message_ptventa_type = 'success';
        }else{
            $message_ptventa = "Se ha producido un error en el momento de actualizar la imagen";
            $message_ptventa_type = 'error';
        }
        return redirect(route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.element.index'))->with('message_ptventa',$message_ptventa)->with('message_ptventa_type',$message_ptventa_type);
    }

}

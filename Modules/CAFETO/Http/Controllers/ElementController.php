<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Validator;

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
        $measurement_units = MeasurementUnit::orderBy('name','ASC')->get();
        $categories = Category::orderBy('name','ASC')->get();
        $kind_of_purchases = KindOfPurchase::orderBy('name','ASC')->get();
        $view = ['titlePage'=>'Productos - Actualizar imagen', 'titleView'=>'Actualizar imagen de producto'];
        $apps = App::get();
        return view('cafeto::element.edit', compact('element', 'view', 'measurement_units', 'categories', 'kind_of_purchases', 'apps'));
    }

    public function update(Request $request, Element $element){ // Actualización de imagen de element
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
            $message_cafeto = "Imagen actualizada exitosamente";
            $message_cafeto_type = 'success';
        }else{
            $message_cafeto = "Se ha producido un error en el momento de actualizar la imagen";
            $message_cafeto_type = 'error';
        }
        return redirect(route('cafeto.element.index'))->with('message_cafeto',$message_cafeto)->with('message_cafeto_type',$message_cafeto_type);
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
        $apps = App::get();
        return view('cafeto::element.create', compact('view', 'measurement_units', 'categories', 'kind_of_purchase', 'apps'));
    }

    public function store(Request $request){
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
            $message_cafeto = "Elemento agregado exitosamente";
            $message_cafeto_type = 'success';
        }else{
            $message_cafeto = "Se ha producido un error en el momento de agregar el elemento";
            $message_cafeto_type = 'error';
        }
        return redirect(route('cafeto.element.index'))->with('message_cafeto', $message_cafeto)->with('message_cafeto_type', $message_cafeto_type);
    }
}

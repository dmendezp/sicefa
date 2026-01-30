<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;

class ElementController extends Controller
{
    public function index()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_element_index_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_element_index_title_view')
        ];

        return view('cafeto::element.index', compact('view'));
    }

    public function create()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_element_create_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_element_create_title_view')
        ];

        $measurement_units = MeasurementUnit::orderBy('name', 'ASC')->get();
        $categories        = Category::orderBy('name', 'ASC')->get();
        $kind_of_purchases = KindOfPurchase::orderBy('name', 'ASC')->get();

        return view('cafeto::element.create', compact('view', 'measurement_units', 'categories', 'kind_of_purchases'));
    }

    public function store(Request $request)
    {
        $request->merge(['price' => revertPriceFormat(e($request->input('price')))]);

        $rules = [
            'name' => 'required|unique:elements,name',
            'measurement_unit_id' => 'required',
            'kind_of_purchase_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'UNSPSC_code' => 'nullable|integer|unique:elements,UNSPSC_code',
            'image' => 'nullable|image|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $element = new Element();
        $element->name = e($request->input('name'));
        $element->slug = Str::slug($element->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $extension  = strtolower($image->getClientOriginalExtension());
            $image_name = $element->slug . '.' . $extension;

            $image->move(public_path('modules/sica/images/elements/'), $image_name);
            $element->image = 'modules/sica/images/elements/' . $image_name;
        }

        $element->measurement_unit_id = e($request->input('measurement_unit_id'));
        $element->description         = e($request->input('description'));
        $element->kind_of_purchase_id = e($request->input('kind_of_purchase_id'));
        $element->category_id         = e($request->input('category_id'));
        $element->price               = e($request->input('price'));

        $UNSPSC_code = e($request->input('UNSPSC_code'));
        $element->UNSPSC_code = !empty($UNSPSC_code) ? $UNSPSC_code : null;

        if ($element->save()) {
            $message_cafeto = "Elemento agregado exitosamente";
            $message_cafeto_type = 'success';
        } else {
            $message_cafeto = "Se ha producido un error en el momento de agregar el elemento";
            $message_cafeto_type = 'error';
        }

        return redirect(route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.element.index'))
            ->with('message_cafeto', $message_cafeto)
            ->with('message_cafeto_type', $message_cafeto_type);
    }

    /**
     * Resolver Element por ID o por SLUG (incluye borrado suave)
     */
    private function resolveElement($value): Element
    {
        return Element::query()
            ->withTrashed()
            ->where('id', $value)
            ->orWhere('slug', $value)
            ->firstOrFail();
    }

    // acepta id o slug en la URL
    public function edit($element)
    {
        $element = $this->resolveElement($element);

        $measurement_units = MeasurementUnit::orderBy('name', 'ASC')->get();
        $categories        = Category::orderBy('name', 'ASC')->get();
        $kind_of_purchases = KindOfPurchase::orderBy('name', 'ASC')->get();

        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_element_edit_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_element_edit_title_view')
        ];

        $existsInFormulations = DB::table('formulations')
            ->where('element_id', $element->id)
            ->exists();

        $originLabel = $existsInFormulations ? 'Formulario' : 'Inventario';

        return view('cafeto::element.edit', compact(
            'element',
            'view',
            'measurement_units',
            'categories',
            'kind_of_purchases',
            'originLabel'
        ));
    }

    // acepta id o slug en la URL
    public function update(Request $request, $element)
    {
        $element = $this->resolveElement($element);

        $request->merge(['price' => revertPriceFormat(e($request->input('price')))]);

        $rules = [
            'name' => 'required|unique:elements,name,' . $element->id,
            'measurement_unit_id' => 'required',
            'kind_of_purchase_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'UNSPSC_code' => 'nullable|integer|unique:elements,UNSPSC_code,' . $element->id,
            'image' => 'nullable|image|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $element->name = e($request->input('name'));
        $element->slug = Str::slug($element->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if (!empty($element->image)) {
                $oldPath = public_path($element->image);
                if (is_file($oldPath)) @unlink($oldPath);
            }

            $extension  = strtolower($image->getClientOriginalExtension());
            $image_name = $element->slug . '.' . $extension;

            $image->move(public_path('modules/sica/images/elements/'), $image_name);
            $element->image = 'modules/sica/images/elements/' . $image_name;
        }

        $element->measurement_unit_id = e($request->input('measurement_unit_id'));
        $element->description         = e($request->input('description'));
        $element->kind_of_purchase_id = e($request->input('kind_of_purchase_id'));
        $element->category_id         = e($request->input('category_id'));
        $element->price               = e($request->input('price'));

        $UNSPSC_code = e($request->input('UNSPSC_code'));
        $element->UNSPSC_code = !empty($UNSPSC_code) ? $UNSPSC_code : null;

        if ($element->save()) {
            $message_cafeto = "Producto actualizado exitosamente";
            $message_cafeto_type = 'success';
        } else {
            $message_cafeto = "Se ha producido un error al actualizar el producto";
            $message_cafeto_type = 'error';
        }

        return redirect(route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.element.index'))
            ->with('message_cafeto', $message_cafeto)
            ->with('message_cafeto_type', $message_cafeto_type);
    }
}

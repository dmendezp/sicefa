<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
// Para validar las imagenes
use Validator, Str;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\CEFAMAPS\Entities\Coordinate;
use Modules\CEFAMAPS\Entities\Page;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\EnvironmentProductiveUnit;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $environ = Environment::with('coordinates','environment_productive_units.productive_unit')->get();
       
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_Index_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'sector'=>$sector, 'classenviron'=>$classenviron];
        return view('cefamaps::admin.environment.index',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add(Request $request)
    {
        $environ = Environment::get();
        $unit = ProductiveUnit::get();
        $unitadd = ProductiveUnit::pluck('name','id');
        $farm = Farm::pluck('name','id');
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $classenvironadd = ClassEnvironment::pluck('name','id');
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_Add_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron, 'sector'=>$sector, 'unitadd'=>$unitadd, 'classenvironadd'=>$classenvironadd];
        return view('cefamaps::admin.environment.add',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addpost(Request $request)
{
    // Guardar la imagen
    $path = 'uploads/';
    $final_name = Str::slug($request->file('file')->getClientOriginalName() . '_' . time()) . '.' . trim($request->file('file')->getClientOriginalName());

    if ($request->file->storeAs($path, $final_name, 'uploads')) {
        $add = new Environment;
        $add->name = e($request->input('name'));
        $add->picture = e($final_name);
        $add->description = e($request->input('description'));
        $add->length = e($request->input('lengthspot'));
        $add->latitude = e($request->input('latitudespot'));
        $add->farm_id = e($request->input('farm_id'));
        $add->class_environment_id = e($request->input('class_environment_id'));
        $add->status = e($request->input('status'));
        $add->type_environment = e($request->input('type'));

        if ($add->save()) {
            // Guardar las unidades productivas seleccionadas
            foreach ($request->input('productive_unit_id') as $unit_id) {
                $environment_productive_units = new EnvironmentProductiveUnit;
                $environment_productive_units->productive_unit_id = $unit_id;
                $environment_productive_units->environment_id = $add->id;
                $environment_productive_units->save();
            }

            // Guardar las coordenadas si están presentes
            if ($request->input('lengthcoor') != '') {
                $c = 0;
                foreach ($request->input('lengthcoor') as $le) {
                    $addcoor = new Coordinate;
                    $addcoor->environment_id = $add->id;
                    $addcoor->length = $le;
                    $addcoor->latitude = e($request->input('latitudecoor')[$c]);
                    $c++;
                    $addcoor->save();
                }
            }
            return redirect(route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.environment.index'));
        }
    }
}


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function edit($id, Request $request)
{
    // Obtener todos los ambientes
    $environ = Environment::get();

    // Obtener todas las unidades productivas
    $unit = ProductiveUnit::get();

    // Obtener nombres de unidades productivas para el select
    $unitedit = ProductiveUnit::pluck('name', 'id');

    // Obtener fincas
    $farm = Farm::pluck('name', 'id');

    // Obtener todos los sectores
    $sector = Sector::get();

    // Obtener todas las clases de ambientes
    $classenviron = ClassEnvironment::get();

    // Obtener ambientes
    $classenvironedit = ClassEnvironment::pluck('name', 'id');

    // Obtener las coordenadas del ambiente
    $editenviron = Environment::with('coordinates')->find($id);

    // Obtener todas las unidades productivas asignadas al ambiente
    $selectedUnits = $editenviron->environment_productive_units->pluck('productive_unit_id')->toArray();


    // Preparar los datos para pasar a la vista
    $data = [
        'titlePage' => trans('cefamaps::controllers.CEFAMAPS_Environment_Edit_title_page'),
        'environ' => $environ,
        'unit' => $unit,
        'farm' => $farm,
        'coor' => $editenviron->coordinates,
        'editenviron' => $editenviron,
        'classenviron' => $classenviron,
        'sector' => $sector,
        'unitedit' => $unitedit,
        'classenvironedit' => $classenvironedit,
        'selectedUnits' => $selectedUnits,
    ];

    // Retornar la vista de edición con los datos
    return view('cefamaps::admin.environment.edit', $data);
}



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function editpost(Request $request)
    {
        $edit = Environment::findOrFail($request->input('id'));
        $edit->name = $request->input('name');
        $edit->description = $request->input('description');
        $edit->farm_id = $request->input('farm_id');
        $edit->length = $request->input('lengthspot');
        $edit->latitude = $request->input('latitudespot');
        $edit->status = $request->input('status');
        $edit->type_environment = $request->input('type');
        $edit->class_environment_id = $request->input('class_environment_id');
    
        if ($request->file('file')) {
            $path = 'uploads/';
            $final_name = Str::slug($request->file('file')->getClientOriginalName() . '_' . time()) . '.' . trim($request->file('file')->getClientOriginalName());
            $request->file->storeAs($path, $final_name, 'uploads');
            $edit->picture = $final_name;
        }
        // Guardar las coordenadas si están presentes
        if ($request->input('lengthcoor') != '') {
            $c = 0;
            foreach ($request->input('lengthcoor') as $le) {
                // Buscar si ya existe una coordenada para este entorno
                $coordinate = Coordinate::where('environment_id', $edit->id)->skip($c)->first();
                
                // Si no existe una coordenada, crea una nueva
                if (!$coordinate) {
                    $coordinate = new Coordinate();
                    $coordinate->environment_id = $edit->id;
                }
                
                // Actualizar los valores de la coordenada
                $coordinate->length = $le;
                $coordinate->latitude = $request->input('latitudecoor')[$c];
                
                // Guardar la coordenada
                $coordinate->save();
                
                $c++;
            }
        }
        
        if ($edit->save()) {
            // Actualizar la relación en la tabla pivot (EnvironmentProductiveUnit)
            $edit->environment_productive_units()->updateOrCreate(
                ['environment_id' => $edit->id],
                ['productive_unit_id' => $request->input('productive_unit_id')[0]]
            );
    
            return redirect()->route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.environment.index');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function eliminar($id)
    {
        $remove = Coordinate::findOrFail($id);
        $remove->delete();
        return response()->json($remove);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addinput(Request $request)
    {
        try {
            $editcoor = new Coordinate;
            $editcoor -> environment_id = $request->id;
            $editcoor -> length = $request->long;
            $editcoor -> latitude =$request->ltn ;
            $editcoor->save();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function view($id, Request $request)
    {
        $unit = ProductiveUnit::get();
        $environ = Environment::get();
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $viewenviron = Environment::where('class_environment_id',$id)->get();
        $pages = Page::get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_View_title_page'), 'unit'=>$unit, 'sector'=>$sector, 'environ'=>$environ, 'classenviron'=>$classenviron, 'viewenviron'=>$viewenviron, 'pages'=>$pages];
        return view('cefamaps::admin.environment.view',$data);
    }


    public function viewenvironments($id, Request $request)
    {
        // Obtener los ambientes asociados a la unidad productiva mediante la relación
        $viewenvironments = ProductiveUnit::findOrFail($id)
        ->environment_productive_units()
        ->with('environment') // Cargar la relación con el ambiente
        ->get()
        ->pluck('environment'); // Obtener solo los ambientes
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $unit = ProductiveUnit::where('id',$id)->get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_View_title_page'),  'viewenvironments'=>$viewenvironments,'sector'=>$sector, 'classenviron'=>$classenviron, 'unit'=>$unit];
        return view('cefamaps::admin.environment.environmentsmap',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function destroy($id)
    {
        $remove = Environment::findOrFail($id);
        $remove->coordinates()->delete();
        $remove->pages()->delete();
        if ($remove->delete()) {
            return back();
        }
    }
}

<?php

namespace Modules\SICA\Http\Controllers\location;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Farm;

class LocationController extends Controller
{

    /* Vista principal de paises */
    public function countries_index(){
        $data = ['title'=>trans('sica::menu.Countries')];
        return view('sica::admin.location.countries.index',$data);
    }

    /* Consultar municipios de manera asincrónica para departamentos y paises */
    public function countries_municipalities_consult(Request $request){
        $data = Municipality::with('department.country')
                ->latest()
                ->get();
        return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="javascript:void(0)" class="edit btn-editar" data-toggle="tooltip" data-placement="top" title="Actualizar registro"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete btn-eliminar text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fas fa-trash-alt"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /* Vista principal de fincas */
    public function farms_index(){
        $farms = Farm::orderByDesc('updated_at')->get();
        $data = ['title'=>trans('sica::menu.Farms'),'farms'=>$farms];
        return view('sica::admin.location.farms.index',$data);
    }

    /* Vista principal de ambientes de formación */
    public function environments_index(){
        $productive_units = ProductiveUnit::get();
        $environments = Environment::orderByDesc('updated_at')->get();
        $data = ['title'=>trans('sica::menu.Environments'),
        'environments'=>$environments,
        'productive_units' => $productive_units
    ];
        return view('sica::admin.location.environments.index',$data);
    }
    /* Filtro de ambientes por unidad productiva */
    public function environments_filter(Request $request){
        $productive_unit_id = $request->input('productive_unit');
        $environments = Environment::whereHas('environment_productive_units', function ($query) use ($productive_unit_id) {
            $query->where('productive_unit_id', $productive_unit_id);
        })
        ->orderByDesc('updated_at')->get();
        $data = ['title'=>trans('sica::menu.Environments'),
        'environments'=>$environments
    ];
        return view('sica::admin.location.environments.table',$data);
    }

    /* Formulario de registro de finca */
    public function farms_create(){
        $data = ['title'=>'Fincas - Registro'];
        return view('sica::admin.location.farms.create',$data);
    }

    /* Registar finca  */
    public function farms_store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'description'=> 'required',
            'area'=> 'required',
            'responsible_id'=> 'required',
            'municipality_id'=> 'required'
        ]);
        if ($validator->fails()) {
            // Almacenar datos del responsable seleccionado de la finca
            Session::flash('responsible_document_number', $request->input('responsible_document_number'));
            Session::flash('responsible_id', $request->input('responsible_id'));
            Session::flash('responsible_full_name', $request->input('responsible_full_name'));
            Session::flash('municipality_id', $request->input('municipality_id'));
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        $request->merge(['person_id'=>$request->input('responsible_id')]); // Reasignar el valor de responsible_id como person_id
        if (Farm::create($request->all())){
            $message = ['message'=>'Se registró exitosamente la finca.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar el registro de la finca.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.location.farms.index'))->with($message);
    }

    /* Formulario de actualización de finca */
    public function farms_edit(Farm $farm){
        $data = ['title'=>'Fincas - Actualización', 'farm'=>$farm];
        return view('sica::admin.location.farms.edit',$data);
    }

    /* Actualizar finca */
    public function farms_update(Request $request, Farm $farm){
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'description'=> 'required',
            'area'=> 'required',
            'responsible_id'=> 'required',
            'municipality_id'=> 'required'
        ]);
        if ($validator->fails()) {
            // Almacenar datos del responsable seleccionado de la unidad productiva
            Session::flash('responsible_document_number', $request->input('responsible_document_number'));
            Session::flash('responsible_id', $request->input('responsible_id'));
            Session::flash('responsible_full_name', $request->input('responsible_full_name'));
            Session::flash('municipality_id', $request->input('municipality_id'));
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Actualizar registro
        $request->merge(['person_id'=>$request->input('responsible_id')]); // Reasignar el valor de leader_id como person_id
        if ($farm->update($request->all())){
            $message = ['message'=>'Se actualizó exitosamente la finca.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo actualizar el registro de la finca.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.location.farms.index'))->with($message);
    }

    /* Eliminar finca */
    public function farms_destroy(Farm $farm){
        if ($farm->delete()){
            $message = ['message'=>'Se eliminó exitosamente la finca.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la finca.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.location.farms.index'))->with($message);
    }

}

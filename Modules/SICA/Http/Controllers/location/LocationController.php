<?php

namespace Modules\SICA\Http\Controllers\location;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Environment;
use DataTables;
use Illuminate\Http\Request;
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
                        <a href="javascript:void(0)" class="edit btn-editar text-success" data-toggle="tooltip" data-placement="top" title="Actualizar registro"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete btn-eliminar text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fas fa-trash-alt"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /* Vista principal de granjas */
    public function farms_index(){
        $farms = Farm::orderByDesc('updated_at')->get();
        $data = ['title'=>trans('sica::menu.Farms'),'farms'=>$farms];
        return view('sica::admin.location.farms.index',$data);
    }

    /* Vista principal de ambientes de formación */
    public function environments_index(){
        $environments = Environment::orderByDesc('updated_at')->get();
        $data = ['title'=>trans('sica::menu.Environments'),'environments'=>$environments];
        return view('sica::admin.location.environments.index',$data);
    }

}

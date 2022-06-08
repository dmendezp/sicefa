<?php

namespace Modules\SICA\Http\Controllers\location;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Environment;
use DataTables;

class LocationController extends Controller
{
    public function countries(){
        //$countries = Municipality::with('department.country')->get();
        //$data = ['title'=>trans('sica::menu.Countries'),'countries'=>$countries];
        //return view('sica::admin.location.countries.home',$data);   
        $data = ['title'=>trans('sica::menu.Countries')];
        return view('sica::admin.location.countries.list',$data);
    }

    public function getCountries(Request $request){

        //if ($request->ajax()) {

            $data = Municipality::with('department.country')->orderby('id','asc')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="javascript:void(0)" class="edit btn-editar text-info" data-toggle="tooltip" data-placement="top" data-id="'.$row->id.'" data-token="'.csrf_token().' title="Editar"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete btn-eliminar text-danger" data-toggle="tooltip" data-placement="top" data-id="'.$row->id.'" data-token="'.csrf_token().' title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        //}  

    }

    public function farms(){
        //$farms = Farm::get();
        $coudepmun = Municipality::where('department_id','421')->get();
        $data = ['title'=>trans('sica::menu.Farms'),'coudepmun'=>$coudepmun];
        return view('sica::admin.location.farms.home',$data);
    }

    public function environments(){
        $environments = Environment::get();
        $data = ['title'=>trans('sica::menu.Environments'),'environments'=>$environments];
        return view('sica::admin.location.environments.home',$data);
    }    
}

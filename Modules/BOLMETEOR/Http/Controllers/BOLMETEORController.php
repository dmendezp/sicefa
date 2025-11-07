<?php

namespace Modules\BOLMETEOR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BOLMETEOR\Entities\Climaticdata;
use DataTables;
use Validator, Str, DB;

class BOLMETEORController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('bolmeteor::index');
    }

    public function getClimaticData(Request $request)
    {
        
        if ($request->ajax()) {

            $data = Climaticdata::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="javascript:void(0)" class="edit btn btn-success btn-sm btn-editar" data-id="'.$row->id.'" data-token="'.csrf_token().'">Edit</a> 
                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm btn-eliminar" data-id="'.$row->id.'" data-token="'.csrf_token().'">Delete</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bolmeteor::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
         // validate

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('bolmeteor::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bolmeteor::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $rules = array(
            'date_time'       => 'required',
            'temperature'      => 'required',
            'precipitation'      => 'required',
            'relative_humidity'      => 'required',
            'solar_radiation'      => 'required',
            'winds_direction'      => 'required',
            'winds_peed'      => 'required'
        );
        
        $validator = $request->validate($rules);

        $c = Climaticdata::findOrFail($request->input('id'));
        $c->date_time = e($request->input('date_time'));
        $c->temperature = e($request->input('temperature'));
        $c->precipitation = e($request->input('precipitation'));
        $c->relative_humidity = e($request->input('relative_humidity'));
        $c->solar_radiation = e($request->input('solar_radiation'));
        $c->winds_direction = e($request->input('winds_direction'));
        $c->winds_peed = e($request->input('winds_peed'));
        $c->save($request->all());
        return ['El registro se guardó correctamente'];
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // Eliminar registro de la tabla
        $note = Climaticdata::find($id);
        if($note != null){
            $note->delete();
        }
        return ['¡Registro eliminado!'];

    }
}

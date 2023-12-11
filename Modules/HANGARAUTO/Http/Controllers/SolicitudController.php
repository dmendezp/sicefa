<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Municipality;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function getSolicitarAdd(Request $request)
    {
        $department = Department::where('country_id','25')->pluck('name','id');
        $municipality = Municipality::where('department_id',$request->department_id)->get();
        $data = ['municipality' => $municipality];

        return view('hangarauto::solicitar', compact('department'), compact('municipality'));
    }
    
    public function postSolicitarAdd(Request $request)
    {
        
    }
    public function getSolicitarSearch(Request $request){
        $department = Department::where('country_id','25')->pluck('name','id');
        $data = ['department' => $department];
        return view('hangarauto::solicitar',$data);
    }

    public function postSolicitarSearch(Request $request)
    {
       
            $people = Person::where('document_number', $request->input('search'))->first();
            $department = Department::where('country_id','25')->pluck('name','id');
            $data = ['people' => $people, 'department' => $department];

            return view('hangarauto::solicitar', $data);
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hangarauto::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hangarauto::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hangarauto::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

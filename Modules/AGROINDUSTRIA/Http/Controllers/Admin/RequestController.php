<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Role;
use Modules\AGROINDUSTRIA\Entities\RequestExternal;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function solicitud()
    {
        $title = 'Solicitud a Centro';
        $coordinator = Role::with('users.person')->where('id', 2)->first()->users->pluck('person');
        $coordinator->transform(function ($person) {
            return $person->first_name . ' ' . $person->first_last_name. ' ' . $person->second_last_name;
        });
        $data = ['title'=>$title, 'coordinator'=>$coordinator];

        return view('agroindustria::admin.solicitudcentro', $data);
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'coordinator' => 'required',
            'receiver' => 'required',
            'ficha' => 'required',
        ]);
    
        $r = new RequestExternal;
    $r->date = $validatedData['date'];
    $r->area = $validatedData['area'];
    $r->coordinator = $validatedData['coordinator'];
    $r->receiver = $validatedData['receiver'];
    $r->region_code = $validatedData['region_code'];
    $r->region_name = $validatedData['region_name'];
    $r->cost_code = $validatedData['cost_code'];
    $r->cost_center_name = $validatedData['cost_center_name'];
    $r->ficha = $validatedData['ficha'];

        return view('agroindustria::create');
    }
    public function store(){
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('agroindustria::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('agroindustria::edit');
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

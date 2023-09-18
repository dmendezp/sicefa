<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SICA\Entities\Activity;
use Modules\HDC\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\activity_environmental_aspects;

class AdminresourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function adminresources() {
        $activity_id = Activity::orderBy('name', 'ASC')->get();
        $environmental_aspect_id = EnvironmentalAspect::orderBy('name', 'ASC')->get();
        return view('hdc::Adminresources',['activity_id' => $activity_id, 'environmental_aspect_id' => $environmental_aspect_id]);

        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hdc::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hdc::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hdc::edit');
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
    public function destroy($productive_unit, $resource)
    {
       //
            
    }

}

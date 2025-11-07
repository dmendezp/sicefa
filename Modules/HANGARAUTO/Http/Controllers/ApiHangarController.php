<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HANGARAUTO\Entities\Petition;
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\HANGARAUTO\Entities\VehicleType;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Municipality;

class ApiHangarController extends Controller
{
    public function solicitudes()
    {
        
        $user = Auth::user();
        $personid = $user->person->id;
        $requests = Petition::where('person_id',$personid)->with('municipality.department','vehicle_type')->orderBy('id','asc')->get();
        return response([
            'solicitudes' => $requests,
        ], 200);
    }

    public function vehicletype()
    {
        $pais = Country::where('name','=','Colombia')->pluck('id');
        $department = Department::where('country_id', $pais)->get();
        $vehicletypes = VehicleType::get();
        return response([
            'vehicletypes' => $vehicletypes,
            'departments' => $department,
        ], 200);
    }

    public function datevehicles(Request $request)
{
    $fechaInicio = $request->input('fechaInicio');
    $tipoVehiculo = $request->input('tipoVehiculo');

    // Ahora puedes utilizar $fechaInicio y $tipoVehiculo en tu lógica de backend
    $vehicletypeid = VehicleType::where('id', $tipoVehiculo)->pluck('id');
    $vehicles = Vehicle::with('petition_assignments.petition')
        ->where('vehicle_type_id', $vehicletypeid)
        ->whereDoesntHave('petition_assignments.petition', function ($query) use ($fechaInicio) {
            $query->where('start_date', '<=', $fechaInicio)
                ->where('end_date', '>=', $fechaInicio);
        })
        ->get();

    return response([
        'vehicles' => $vehicles,
    ], 200);
}

    public function municipalities($departamentoId)
    {
        $department = Department::where('id',$departamentoId)->pluck('id');
        $municipalities = Municipality::where('department_id', $department)->get();
        return response([
            'municipalities' => $municipalities,
        ], 200);
    }


    public function registersolicitud(Request $request){
        
        // Obtiene el usuario autenticado
        $user = Auth::user();
        $personid = $user->person->id;
        $petitionexits = Petition::where('start_date',$request->input('start_date'))->get();
        if ($petitionexits) {
            $p = new Petition;
            $p->start_date = $request->input('start_date');
            $p->end_date = $request->input('end_date');
            $p->municipality_id = $request->input('municipality');
            $p->reason = $request->input('reason');
            $p->numstudents = $request->input('numstudents');
            $p->vehicle_type_id = $request->input('vehicletype');
            $p->person_id = $personid;
            $p->status = 'Solicitud';
            if ($p->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return response(['petition',$petitionexits],403);
        }
       
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

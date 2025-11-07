<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HANGARAUTO\Entities\Tecnomecanic;
use Modules\HANGARAUTO\Entities\Soat;
use Carbon\Carbon;


class HangarAutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->notificationsoatytecno();
        return view('hangarauto::index');
    }

    public function notificationsoatytecno()
{
    // Obtener la fecha actual
    $currentDate = Carbon::now();

    // Obtener el registro más reciente de Soat
    $latestSoat = Soat::latest()->first();

    // Obtener el registro más reciente de Tecnomecánica
    $latestTecnomecanica = Tecnomecanic::latest()->first();

    // Arreglos para almacenar las notificaciones de vencimiento
    $notificationsSoat = [];
    $notificationsTecnomecanica = [];

    // Contadores para contar las notificaciones de vencimiento
    $countSoat = 0;
    $countTecnomecanica = 0;

    // Verificar Soat más reciente
    if ($latestSoat) {
        // Calcular la diferencia en meses entre la fecha actual y la fecha de vencimiento del Soat
        $diffMonths = $currentDate->diffInMonths($latestSoat->expiration_date, false);

        // Si quedan menos de dos meses para que se venza el Soat, agregarlo a las notificaciones
        if ($diffMonths < 2) {
            $notificationsSoat[] = [
                'vehicle' => $latestSoat->vehicle->name,
                'expiration_date' => $latestSoat->expiration_date,
            ];
            $countSoat++;
        }
    }

    // Verificar Tecnomecánica más reciente
    if ($latestTecnomecanica) {
        // Calcular la diferencia en meses entre la fecha actual y la fecha de vencimiento de la Tecnomecánica
        $diffMonths = $currentDate->diffInMonths($latestTecnomecanica->expiration_date, false);

        // Si quedan menos de dos meses para que se venza la Tecnomecánica, agregarlo a las notificaciones
        if ($diffMonths < 2) {
            $notificationsTecnomecanica[] = [
                'vehicle' => $latestTecnomecanica->vehicle->name,
                'expiration_date' => $latestTecnomecanica->expiration_date,
            ];
            $countTecnomecanica++;
        }
    }

    // Almacenar las notificaciones en la sesión
    Session::put('notificationsSoat', $notificationsSoat);
    Session::put('notificationsTecnomecanica', $notificationsTecnomecanica);

    // Almacenar el recuento de notificaciones en la sesión
    Session::put('countSoat', $countSoat);
    Session::put('countTecnomecanica', $countTecnomecanica);
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

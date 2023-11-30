<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\CourseSenaempresa;
use Modules\SICA\Entities\Quarter;


class SENAEMPRESAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = ['title' => trans('senaempresa::menu.Home')];
        return view('senaempresa::index', $data);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function Developers()
    {
        $data = ['title' => trans('senaempresa::menu.Developers')];
        return view('senaempresa::Company.developers', $data);
    }

    public function Admin()
    {
        $registeredphasesCount = DB::table('senaempresas')
            ->whereNull('deleted_at')
            ->count();

        $registeredStaffCount = DB::table('staff_senaempresas')
            ->whereNull('deleted_at')
            ->count();

        $activePositionsCount = PositionCompany::where('state', 'activo')->count();
        $deletedPositionsCount = PositionCompany::onlyTrashed()->count();

        $totalPositionsCount = $activePositionsCount + $deletedPositionsCount;
        $data = [
            'title' => 'Administrador', 'totalPositionsCount' => $totalPositionsCount,
            'registeredStaffCount' => $registeredStaffCount, 'registeredphasesCount' => $registeredphasesCount
        ];
        return view('senaempresa::Company.admin', $data);
    }
    public function human_talent_leader()
    {
        $data = ['title' => 'Lider de talento humano'];
        return view('senaempresa::Company.human_talent_leader', $data);
    }
    public function Apprentice()
    {
        $data = ['title' => 'Aprendiz'];
        return view('senaempresa::index', $data);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function seleccionados()
    {
        $data = ['title' => 'Seleccionados'];
        return view('senaempresa::Company.Postulate.Application', $data);
    }
}

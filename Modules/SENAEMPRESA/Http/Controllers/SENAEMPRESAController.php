<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SENAEMPRESA\Entities\Senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\CourseSenaempresa;
use Modules\SICA\Entities\Quarter;
use Modules\SENAEMPRESA\Entities\postulate;


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
        $vacanciesCount = DB::table('vacancies')
            ->where('state', 'Disponible')
            ->whereNull('deleted_at')
            ->count();
        $prestamosPrestados = DB::table('loans')
            ->where('state', 'Prestado')
            ->whereNull('deleted_at')
            ->count();
        $postulatesCount = DB::table('postulates')
            ->whereNull('deleted_at')
            ->count();
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
            'title' => trans('senaempresa::menu.Administrator'), 'totalPositionsCount' => $totalPositionsCount,
            'registeredStaffCount' => $registeredStaffCount, 'registeredphasesCount' => $registeredphasesCount, 'postulatesCount' => $postulatesCount,
            'prestamosPrestados' => $prestamosPrestados, 'vacanciesCount' => $vacanciesCount
        ];
        
        return view('senaempresa::Company.admin', $data);
    }

    public function manual_admin()
    {
       $data = ['title' => trans('senaempresa::menu.manual')];
       return view('senaempresa::Company.manual.manual_admin', $data);
   }
    public function human_talent_leader()
    {
        $registeredStaffCount = DB::table('staff_senaempresas')
            ->whereNull('deleted_at')
            ->count();

        $prestamosPrestados = DB::table('loans')
            ->where('state', 'Prestado')
            ->whereNull('deleted_at')
            ->count();
        $data = [
            'title' => trans('senaempresa::menu.Human talent leader'), 'prestamosPrestados' => $prestamosPrestados,
            'registeredStaffCount' => $registeredStaffCount
        ];
        return view('senaempresa::Company.human_talent_leader', $data);
    }

    public function manual_human_talent_leader()
    {
       $data = ['title' => trans('senaempresa::menu.manual')];
       return view('senaempresa::Company.manual.manual_human_talent_leader', $data);
   }
    public function psychologo()
    {
        $postulatesCount = DB::table('postulates')
            ->whereNull('deleted_at')
            ->count();

        $data = [
            'title' => trans('senaempresa::menu.Psychologo'), 'postulatesCount' => $postulatesCount
        ];
        return view('senaempresa::Company.psychologo', $data);
    }
    public function manual_psychologo()
    {
       $data = ['title' => trans('senaempresa::menu.manual')];
       return view('senaempresa::Company.manual.manual_psychologo', $data);
   }
    public function Apprentice()
    {
        $vacanciesCount = DB::table('vacancies')
            ->where('state', 'Disponible')
            ->whereNull('deleted_at')
            ->count();
        $data = ['title' => trans('senaempresa::menu.Apprentice'), 'vacanciesCount' => $vacanciesCount];
        return view('senaempresa::Company.apprentice', $data);
    }
    public function manual_apprentice()
    {
       $data = ['title' => trans('senaempresa::menu.manual')];
       return view('senaempresa::Company.manual.manual_apprentice', $data);
   }

}

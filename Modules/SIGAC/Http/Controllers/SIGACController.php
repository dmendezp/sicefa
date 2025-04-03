<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Employee;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\Role;
use Modules\SIGAC\Entities\Profession;

class SIGACController extends Controller
{

    public function index()
    {
        $employees = Employee::where('employee_type_id', 2)->where('state', 'Activo')->get();
        $contractors = Contractor::where('contract_end_date', '>=', now())->where('employee_type_id', 2)->get();
        $apprentices = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->get();

        $view = [
            'titlePage' => trans('sigac::controllers.SIGAC_index_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_index_title_view'),
            'apprentices' => $apprentices,
            'employees' => $employees,
            'contractors' => $contractors
        ];
        return view('sigac::index', $view);
    }

    public function proof()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_index_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_index_title_view')];
        return view('sigac::proof', $view);
    }

    public function info()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_info_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_info_title_view')];
        return view('sigac::information.index', $view);
    }

    public function devs()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_devs_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_devs_title_view')];
        return view('sigac::developers.index', $view);
    }

    public function directory_dashboard()
    {
        $vinculacion = collect([
            ['id' => null, 'name' => trans('sigac::directory.SelectAnRol')],
            ['id' => 1, 'name' => 'Funcionario'],
            ['id' => 2, 'name' => 'Contratista'],
        ])->pluck('name', 'id');

        $getEmployees = EmployeeType::all();
        $employees = $getEmployees->map(function ($i) {
            $id = $i->id;
            $name = $i->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::directory.SelectAnBonding')])->pluck('name', 'id');

        $getProffesions = Profession::all();
        $proffesions = $getProffesions->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::directory.SelectAnProfession')])->pluck('name', 'id');

        $view = [
            'titlePage' => trans('sigac::controllers.SIGAC_directory_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_directory_title_view'),
            'employees' => $employees,
            'vinculacion' => $vinculacion,
            'proffesions' => $proffesions,
        ];

        return view('sigac::directory.index', $view);
    }

    /* Panel de control de coordinación académica */
    public function academic_coordination_dashboard()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_view')];
        return view('sigac::index_academic_coordination', $view);
    }

    /* Panel de control del instructor */
    public function instructor_dashboards()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_instructor_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_instructor_dashboard_title_view')];
        return view('sigac::index_instructor', $view);
    }

    /* Panel de control de bienestar */
    public function wellness_dashboard()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_wellness_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_wellness_dashboard_title_view')];
        return view('sigac::index_wellness', $view);
    }

    /* Panel de control de aprendiz */
    public function apprentice_dashboard()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_apprentice_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_apprentice_dashboard_title_view')];
        return view('sigac::index_apprentice', $view);
    }

    /* Panel de control de apoyo */
    public function support_dashboard()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_support_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_support_dashboard_title_view')];
        return view('sigac::index_wellness', $view);
    }

    /* Panel de control de apoyo */
    public function securitystaff_dashboard()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_support_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_support_dashboard_title_view')];
        return view('sigac::index_wellness', $view);
    }

    public function directory_search(Request $request)
    {
        $vinculacion = $request->vinculacion;
        $employeeTypeId = $request->rol;
        $profesion = $request->profesion;
        $lider = filter_var($request->lider, FILTER_VALIDATE_BOOLEAN);
        
        $directoryData = [];

        if (in_array($vinculacion, [1, 2])) {
            $tableJoin = $vinculacion == 1 ? 'employees' : 'contractors'; 
            $vinculacionValue = $vinculacion;

            $directoryData = DB::table('people')
            ->join('users', 'people.id', '=', 'users.person_id')
            ->join($tableJoin, 'users.person_id', '=', "$tableJoin.person_id") 
            ->join('employee_types', function ($join) use ($employeeTypeId, $tableJoin) {
                $join->on("$tableJoin.employee_type_id", '=', 'employee_types.id');
                if (!empty($employeeTypeId)) {
                    $join->where('employee_types.id', $employeeTypeId);
                }
            })
            ->join('person_professions', function ($join) use ($profesion) {
                $join->on('users.person_id', '=', 'person_professions.person_id');
                if (!empty($profesion)) {
                    $join->where('person_professions.profession_id', $profesion);
                }
            })
            ->join('professions', 'person_professions.profession_id', '=', 'professions.id')
            ->when($lider == true, function ($query) { 
                // Si $lider es true, hacer otro join
                $query->join('courses', 'users.person_id', '=', 'courses.person_id');
            })
            ->select(
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'employee_types.name as rol',
                'people.personal_email',
                'people.misena_email',
                'people.sena_email',
                'people.telephone1',
                DB::raw("$vinculacionValue as vinculacion"),
                'professions.name as profession'
            )
            ->get();
        }

        return view('sigac::directory.table')->with([
            'titlePage' => 'Consultar directorio',
            'titleView' => 'Consultar directorio',
            'directoryData' => $directoryData
        ]);
    }
}

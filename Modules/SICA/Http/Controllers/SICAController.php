<?php

namespace Modules\SICA\Http\Controllers;

use App\Models\User;
Use DB;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Event;
use Modules\SICA\Entities\EventAttendance;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Inventory;

class SICAController extends Controller
{

    /* Página principal de la aplicación SICA */
    public function index(){
        // Nombres de los tipos de empleados que quieres incluir
        $employeeTypeNames = ['Contratista', 'Planta Temporal', 'Planta Provisional', 'Carrera Administrativa'];

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $instructors = DB::table('employees')
                    ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'employees.person_id', '=', 'people.id')
                    ->whereIn('employee_types.name', $employeeTypeNames)
                    ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    ->union(
                        DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->whereIn('employee_types.name', $employeeTypeNames)
                            ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    )
                    ->count();

        $category = Category::where('name','=','Maquinaria')->pluck('id');
        $machinery = Inventory::whereHas('element', function ($query) use ($category) {
            $query->where('category_id', $category);
        })->where('amount','>','0')
        ->count();

        $data = [
            'title' => trans('sica::menu.Home'),
            'people' => Person::count(),
            'apprentices' => Apprentice::count(),
            'apps' => App::count(),
            'productive_units' => ProductiveUnit::count(),
            'roles' => Role::count(),
            'users' => User::count(),
            'environments' => Environment::count(),
            'elements' => Element::count(),
            'programs' => Program::count(),
            'instructors' => $instructors,
            'machinery' => $machinery
        ];
        return view('sica::index',$data);
    }

    /* Página de información sobre desarrolladores */
    public function developers(){
        $data = ['title'=>trans('sica::menu.Developers')];
        return view('sica::developers',$data);
    }

    /* Página de contacto */
    public function contact(){
        $data = ['title'=>trans('sica::menu.Contact')];
        return view('sica::form_contact',$data);
    }

    /* Panel de control del administrdor */
    public function admin_dashboard(){
        // Nombres de los tipos de empleados que quieres incluir
        $employeeTypeNames = ['Contratista', 'Planta Temporal', 'Planta Provisional', 'Carrera Administrativa'];

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $instructors = DB::table('employees')
                    ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'employees.person_id', '=', 'people.id')
                    ->whereIn('employee_types.name', $employeeTypeNames)
                    ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    ->union(    
                        DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->whereIn('employee_types.name', $employeeTypeNames)
                            ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    )
                    ->count();
        $category = Category::where('name','=','Maquinaria')->pluck('id');
        $machinery = Inventory::whereHas('element', function ($query) use ($category) {
            $query->where('category_id', $category);
        })->where('amount','>','0')
        ->count();
        $data = [
            'title' => trans('sica::menu.admin_dashboard'),
            'people' => Person::count(),
            'apprentices' => Apprentice::count(),
            'courses' => Course::count(),
            'environments' => Environment::count(),
            'elements' => Element::count(),
            'productive_units' => ProductiveUnit::count(),
            'apps' => App::count(),
            'roles' => Role::count(),
            'users' => User::count(),
            'instructors' => $instructors,
            'machinery' => $machinery
        ];
        return view('sica::admin_dashboard', $data);
    }

    /* Panel de control del coordinador académico */
    public function academic_coordinator_dashboard(){
        // Nombres de los tipos de empleados que quieres incluir
        $employeeTypeNames = ['Contratista', 'Planta Temporal', 'Planta Provisional', 'Carrera Administrativa'];

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $instructors = DB::table('employees')
                    ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'employees.person_id', '=', 'people.id')
                    ->whereIn('employee_types.name', $employeeTypeNames)
                    ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    ->union(    
                        DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->whereIn('employee_types.name', $employeeTypeNames)
                            ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    )
                    ->count();
        $data = [
            'title' => trans('sica::menu.academic_coordinator_dashboard'),
            'people' => Person::count(),
            'apprentices' => Apprentice::count(),
            'courses' => Course::count(),
            'environments' => Environment::count(),
            'instructors' => $instructors,
        ];
        return view('sica::academic_coordinator_dashboard', $data);
    }

    /* Panel de control de asistencias a eventos */
    public function attendance_dashboard(){
        $events = Event::get();
        $eas = $events;
        $i=0;
        foreach($events as $e){
            $attendance = EventAttendance::select('date',DB::raw('count(id) as total'))
                                        ->where('event_id',$e->id)
                                        ->groupBy('date')
                                        ->get();
            $dis = EventAttendance::where('event_id',$e->id)
                                    ->distinct()
                                    ->count('person_id');
            $disp = EventAttendance::select('person_id')
                                    ->where('event_id',$e->id)
                                    ->distinct()
                                    ->get();
            $rage=  Person::select('document_type', DB::raw('count(document_type) as val'))
                            ->whereIN('id',$disp)
                            ->groupBy('document_type')
                            ->get();
            /* $pop = Person::select('population_groups.name', DB::raw('count(population_group_id) as val'))
                            ->whereIN('people.id',$disp)
                            ->groupBy('population_group_id')
                            ->join('population_groups', 'people.population_group_id', '=', 'population_groups.id')
                            ->get(); */
            $pop = Person::select('population_groups.name', DB::raw('count(population_group_id) as val'))
                                ->whereIn('people.id', $disp)
                                ->groupBy('population_groups.name') // Agregado 'name' al GROUP BY
                                ->join('population_groups', 'people.population_group_id', '=', 'population_groups.id')
                                ->get();
            $eas[$i]['attendance']=$attendance;
            $eas[$i]['total']=$dis;
            $eas[$i]['rage']=$rage;
            $eas[$i]['pop']=$pop;
            $i++;
        }
        //return $eas;
        $attendance = EventAttendance::select('date',DB::raw('count(id) as total'))->groupBy('date')->with('event')->get();
        $data = [
            'title' => trans('sica::menu.attendance_dashboard'),
            'people' => Person::count(),
            'apprentices' => Apprentice::count(),
            'events' => Event::count(),
            'courses' => Course::count(),
            'environments' => Environment::count(),
            'eas' => $eas,
            'attendance' => $attendance,
        ];
        return view('sica::attendance_dashboard', $data);
    }

    /* Panel de control del gestor de unidades */
    public function unitmanager_dashboard(){
        $data = [
            'title' => trans('sica::menu.unitmanager_dashboard'),
            'environments' => Environment::count(),
            'productive_units' => ProductiveUnit::count(),
        ];
        return view('sica::unitmanager_dashboard', $data);
    }

}

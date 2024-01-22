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

class SICAController extends Controller
{

    /* Página principal de la aplicación SICA */
    public function index(){
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
            'programs' => Program::count()
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
        ];
        return view('sica::admin_dashboard', $data);
    }

    /* Panel de control del coordinador académico */
    public function academic_coordinator_dashboard(){
        $data = [
            'title' => trans('sica::menu.academic_coordinator_dashboard'),
            'people' => Person::count(),
            'apprentices' => Apprentice::count(),
            'courses' => Course::count(),
            'environments' => Environment::count(),
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

}

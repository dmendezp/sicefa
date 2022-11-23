<?php

namespace Modules\SICA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\App;

use App\Models\User;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\EventAttendance;
Use DB;

class SICAController extends Controller
{

    public function index()
    {
        $data = ['title'=>trans('sica::menu.Home')];
        return view('sica::index',$data);
    }

    public function contact()
    {
        $data = ['title'=>trans('sica::menu.Contact')];
        return view('sica::form_contact',$data);
    }

    public function developers()
    {
        $data = ['title'=>trans('sica::menu.Developers')];
        return view('sica::developers',$data);
    }

    public function admin_dashboard()
    {
        $people = Person::count();
        $apprentices = Apprentice::count();
        $apps = App::count();
        $users = User::count();
        $roles = Role::count();
        $courses = Course::count();
        $data = ['title'=>trans('sica::menu.Dashboard'),'people'=>$people,'apprentices'=>$apprentices,'apps'=>$apps,'users'=>$users,'roles'=>$roles,'courses'=>$courses];
        return view('sica::admin.dashboard',$data);
    }

    public function attendance_dashboard()
    {
        $people = Person::count();
        $apprentices = Apprentice::count();
        $attendance = EventAttendance::select('date',DB::raw('count(id) as total'))->groupBy('date')->with('event')->get();
        $data = ['title'=>trans('sica::menu.Dashboard'),'people'=>$people,'apprentices'=>$apprentices,'attendance'=>$attendance];
        return view('sica::admin.attendance_dashboard',$data);
    }

}

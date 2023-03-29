<?php

namespace Modules\GANADERIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
<<<<<<< HEAD


use App\Models\User;
use Modules\GANADERIA\Entities\Role;
use Modules\GANADERIA\Entities\Course;
=======
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\App;

use App\Models\User;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Course;
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27


class AdminController extends Controller
{
<<<<<<< HEAD
    
   
   /**
=======
    /**
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
<<<<<<< HEAD
       return view('ganaderia::admin.dashboard');
       
    }
   
   /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function home2()
    {
       return view('ganaderia::admin.apprentice_leader.home2');
       
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function home()
    {
       return view('ganaderia::admin.veterinary.home');
       
    }

    public function index()
    {
       return view('ganaderia::admin.reproduction.index');
       
    }
    public function index2()
    {
       return view('ganaderia::admin.inventory.index2');
       
    }
    
   }

=======
        $people = Person::count();
        $apprentices = Apprentice::count();
        $apps = App::count();
        $users = User::count();
        $roles = Role::count();
        $courses = Course::count();
        $data = ['title'=>trans('ganaderia::menu.Dashboard'),'people'=>$people,'apprentices'=>$apprentices,'apps'=>$apps,'users'=>$users,'roles'=>$roles,'courses'=>$courses];
        return view('ganaderia::admin.dashboard',$data);
    }

}
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27

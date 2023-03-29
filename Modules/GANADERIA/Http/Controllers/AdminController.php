<?php

namespace Modules\GANADERIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


use App\Models\User;
use Modules\GANADERIA\Entities\Role;
use Modules\GANADERIA\Entities\Course;


class AdminController extends Controller
{
    
   
   /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
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
   }


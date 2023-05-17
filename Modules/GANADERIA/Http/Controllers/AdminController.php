<?php

namespace Modules\GANADERIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\User;
use Modules\GANADERIA\Entities\Role;
use Modules\GANADERIA\Entities\Course;
use Modules\GANADERIA\Entities\Animal;


class AdminController extends Controller
{
   public function dashboard()
   {
      return view('ganaderia::admin.dashboard');
       
   }

   public function home2()
   {
      return view('ganaderia::admin.apprentice_leader.home2');
       
   }

   public function home()
   {
      return view('ganaderia::admin.veterinary.home');
       
   }

   public function index()
   {
      return view('ganaderia::admin.reproduction.index');
   }

   public function animals(Request $request) {
      $animalsId = $request->input('animal_id');
      $animals = Animal::all();
      $selectedAnimal = $animalsId ? Animal::findOrFail($animalsId) : null;
      return view('ganaderia::admin.filter.animals', compact('animals', 'selectedAnimal'));
   }
}


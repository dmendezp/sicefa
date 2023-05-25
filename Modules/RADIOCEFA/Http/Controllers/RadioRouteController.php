<?php

namespace Modules\RADIOCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\RADIOCEFA\Entities\Parrilla;

class RadioRouteController extends Controller
{
    // ruta para peticiones
    public function Expresate()
    {
        return view('radiocefa::Expresate');
    }

    // // ruta para cronograma
      public function cronograma()
     {
         return view('radiocefa::cronograma');
     }

     // // ruta para votaciones
     public function votes()
     {
         return view('radiocefa::votaciones');
     }

     // // ruta para votaciones
     public function sobrenosotros()
     {
         return view('radiocefa::aboutUs');
     }

     public function parrilla()
     {
        $parrilla = Parrilla::get();
        
        return json_encode($parrilla);
     }


}
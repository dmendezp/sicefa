<?php

namespace Modules\GANADERIA\Http\Controllers\inventory;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;





class InventoryController extends Controller
{
   
    public function supplies(){
        
        $data = ['title'=>trans('ganaderia::menu.Inventory')];
        return view('ganaderia::admin.supplies.home',$data);
    }

    public function entryMedications(){
        
        $data = ['title'=>trans('ganaderia::menu.Inventory')];
        return view('ganaderia::admin.entryMedications.home',$data);
    }

    public function movementsmedicine(){
        
        $data = ['title'=>trans('ganaderia::menu.Inventory')];
        return view('ganaderia::admin.movementsmedicine.home',$data);
    }

    public function animals(){
        
        $data = ['title'=>trans('ganaderia::menu.Inventory')];
        return view('ganaderia::admin.animals.home',$data);
    }

    

    

   




    }
    

  

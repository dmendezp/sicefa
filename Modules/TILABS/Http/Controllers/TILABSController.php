<?php

namespace Modules\TILABS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TILABSController extends Controller
{

    public function index()
    {        
        $view = ['titlePage' => trans('tilabs::controllers.TILABS_index_title_page'), 'titleView' => trans('tilabs::controllers.TILABS_index_title_view')];
        return view('tilabs::index',compact('view'));
    }

    public function developers()
    {
        $view = ['titlePage' => 'Desarrolladores', 'titleView' => 'Principal'];
        return view('tilabs::developers', compact('view'));
    }

    public function about()
    {
        $view = ['titlePage' => 'Acerca de', 'titleView' => 'Principal'];
        return view('tilabs::about.index', compact('view'));
    }

    public function dashboard()
    {
        $view = ['titlePage' => 'Administrador', 'titleView' => 'Principal'];
        return view('tilabs::admin.dashboard',compact('view'));
    }

    public function labs()
    {
        $view = ['titlePage' => 'Labs', 'titleView' => 'Labs'];
        return view('tilabs::admin.labs.index',compact('view'));
    } 

    public function inventory()
    {
        $view = ['titlePage' => 'Inventario', 'titleView' => 'Principal'];
        return view('tilabs::admin.inventory.index',compact('view'));
    }   

    public function loan()
    {
        $view = ['titlePage' => 'Préstamo', 'titleView' => 'Principal'];
        return view('tilabs::admin.loan.index',compact('view'));
    }
    
    public function return()
    {
        $view = ['titlePage' => 'Regreso', 'titleView' => 'Principal'];
        return view('tilabs::admin.return.index',compact('view'));
    }
    
    public function transactions()
    {
        $view = ['titlePage' => 'Movimientos', 'titleView' => 'Principal'];
        return view('tilabs::admin.transactions.index',compact('view'));
    }
        
}

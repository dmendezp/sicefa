<?php

namespace Modules\SICA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        $data = ['title'=>trans('sica::menu.Dashboard')];
        return view('sica::admin.dashboard',$data);
    }

}

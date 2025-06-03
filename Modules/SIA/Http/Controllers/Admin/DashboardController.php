<?php

namespace Modules\SIA\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Bienvenido administrador'];
        return view('sia::admin.dashboard', $data);
    }
}
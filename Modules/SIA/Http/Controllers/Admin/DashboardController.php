<?php

namespace Modules\SIA\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Bienvenido administrador'];
        return view('sia::admin.dashboard', $data);
    }
}
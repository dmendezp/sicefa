<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaborManagementController extends Controller
{
    public function index()
    {
        return view('agrocefa::labormanagement.index');
    }

    public function culturalwork()
    {
        return view('agrocefa::labormanagement.culturalwork');
    }
}

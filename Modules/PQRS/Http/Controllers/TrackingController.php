<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TrackingController extends Controller
{
    public function index(){
        $titlePage = 'Seguimiento PQRS';
        $titleView = 'Seguimiento PQRS';

        $data  = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
        ];

        return view('pqrs::tracking.index', $data);
    }
}

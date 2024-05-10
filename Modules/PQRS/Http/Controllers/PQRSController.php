<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PQRSController extends Controller
{
    public function index(){
        $titlePage = 'Inicio';
        $titleView = 'Inicio';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView
        ];

        return view('pqrs::index', $data);
    }
}

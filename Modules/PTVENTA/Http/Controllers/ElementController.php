<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Validator;


class ElementController extends Controller
{
    public function index()
    {
        $element = Element::all();
        $titleView = 'Administración de productos generales';
        $view = ['titlePage' => 'Productos'];
        return view('ptventa::element.index', compact('element','titleView','view'));
    }

    public function edit(Element $element)
    {
        $titleView = 'Actualización de productos generales';
        $view = ['titlePage' => 'Actualizar | Producto'];
        return view('ptventa::element.edit', compact('element','titleView','view'));
    }
}

<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;



class PTVENTAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $titleView = 'Bienvenido a Punto de Venta!';
        $view = ['titlePage' => 'Inicio'];
        return view('ptventa::index', compact('view', 'titleView'));
    }

    public function indexSales()
    {
        $titleView = 'Sección de Ventas';
        $view = ['titlePage' => 'Ventas'];
        return view('ptventa::sales/index', compact('view', 'titleView'));
    }

    public function indexInventory()
    {
        $titleView = 'Inventariado';
        $view = ['titlePage' => 'Inventario de Productos'];
        return view('ptventa::inventory/index', compact('view', 'titleView'));
        
    }
    

    public function indexProducts()
    {
        $product = Element::all();
        $titleView = 'Sección de Productos';
        $view = ['titlePage' => 'Productos'];
        return view('ptventa::products/index', compact('product','view', 'titleView'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ptventa::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ptventa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ptventa::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

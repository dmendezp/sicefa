@extends('agroindustria::layouts.master')
@section('content')

<h1 class="title_labor">Inventario de {{ session('viewing_unit_name') }}</h1>

<div class="table-labors">
    <table id="inventory" class="table table-striped" style="width: 98%;">
        <thead>
            <tr>
               <th>Producto</th>
               <th>Categoria</th>
               <th>Unidad de Medida</th>
               <th>Cantidad</th>
               <th>Precio</th>
               <th>Fecha Producción</th>
               <th>Fecha Expiración</th>
               <th>Lote</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $i)         
            <tr>
                <td>{{$i->element->name}}</td>
                <td>{{$i->element->category->name}}</td>
                <td>{{$i->element->measurement_unit->name}}</td>
                <td>{{$i->amount}}</td>
                <td>{{$i->price}}</td>
                <td>{{$i->production_date}}</td>
                <td>{{$i->expiration_date}}</td>
                <td>{{$i->lot_number}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

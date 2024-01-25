@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
    <div class="card" style="width: 1100px">
        <table id="inventoryExp" class="table table-striped" style="width: 98%;">
            <br>    
            <center><h4>Insumos pronto a caducar y caducados.</h4></center>
            <br>
            <thead>
                <tr>
                    <th>{{trans('agroindustria::menu.Name')}}</th>
                    <th>Categoría</th>
                    <th>Unidad de Medida</th>
                    <th>Cantidad</th>
                    <th>Fecha expiración</th>
                    <th>Lote</th>
                    <th>Estado</th>
                    @if(auth()->check() && (checkRol('agroindustria.admin')))  
                    <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($expirationdate as $item)
                    @if ($item['amount'] > 0) 
                        <tr>
                            <td>{{ $item['element_name'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td>{{ $item['measurement_unit'] }}</td>
                            <td>{{ $item['amount'] }}</td>
                            <td>{{ $item['expiration_date'] }}</td>
                            <td>{{ $item['lot_number'] }}</td>
                            <td>{{ $item['state'] }}</td>
                            @if(auth()->check() && (checkRol('agroindustria.admin')))  
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dischargeModal{{$item['inventory_id']}}">
                                    Dar baja
                                </button>
                                @include('agroindustria::storer.inventory.discharge')
                            </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</center>
@endsection

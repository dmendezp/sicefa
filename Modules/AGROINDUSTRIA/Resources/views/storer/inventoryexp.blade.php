@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
    <div class="card" style="width: 1100px">
        <table class="table table-striped-columns">
            <br>    
            <center><h4>Insumos pronto a caducar y caducados.</h4></center>
            <br>
            <thead>
                <tr>
                    <th>ID del Elemento</th>
                    <th>{{trans('agroindustria::menu.Name')}}</th>
                    <th>Categoría</th>
                    <th>Unidad de Medida</th>
                    <th>Cantidad</th>
                    <th>Fecha expiración</th>
                    <th>Lote</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expirationdate as $item)
                    <tr>
                        <td>{{ $item['element_id'] }}</td>
                        <td>{{ $item['element_name'] }}</td>
                        <td>{{ $item['category'] }}</td>
                        <td>{{ $item['measurement_unit'] }}</td>
                        <td>{{ $item['amount'] }}</td>
                        <td>{{ $item['expiration_date'] }}</td>
                        <td>{{ $item['lot_number'] }}</td>
                        <td>{{ $item['state'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</center>
@endsection

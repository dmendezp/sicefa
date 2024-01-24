@extends('agroindustria::layouts.master')
@section('content')
    <h1 style="text-align: center">Producción</h1>
    <div class="production" style="margin-left:20px; margin-right:20px;">
        <table id="table-production" class="hover" style="width: 100%;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha Expiración</th>
                    <th>Lote</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($production as $p)                
                <tr>
                    <td>{{$p->element->name}}</td>
                    <td>{{$p->amount}}</td>
                    <td>{{$p->expiration_date}}</td>
                    <td>{{$p->lot}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@section('script')
@endsection
@endsection
@extends('agrocefa::layouts.master')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="container" id="containermovements">
        <h2>Movimientos de Entrada Pendientes</h2>
        <div class="container my-5">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Responsable</th>
                                    <th>Unidad Productiva</th>
                                    <th>Bodega</th>
                                    <th>Elementos</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data['id'] }}</td>
                                        <td>{{ $data['date'] }}</td>
                                        <td>{{ $data['respnsibility'] }}</td>
                                        <td>{{ $data['productiveunit'] }}</td>
                                        <td>{{ $data['warehouse'] }}</td>
                                        <td>{{ $data['inventory'] }}</td>
                                        <td>{{ $data['amount'] }}</td>
                                        <td>{{ $data['price'] }}</td>
                                        <td>{{ $data['state'] }}</td>
                                        <td>
                                            {!! Form::open(['route' => ['agrocefa.movements.confirmation', $data['id']], 'method' => 'POST']) !!}
                                            @csrf
                                            {!! Form::hidden('inventory_id', $data['inventory_id']) !!}
                                            {!! Form::hidden('amount', $data['amount']) !!}
                                            {!! Form::hidden('price', $data['price']) !!}
                                            {!! Form::submit('Confirmar', ['class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

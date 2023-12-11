@extends('agrocefa::layouts.master')

@section('content')

<div class="container" id="containermovements">
    <h2>Historial de Movimientos</h2>
    @if (count($datas) > 0)
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
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $currentId = null; @endphp
                            @foreach ($datas as $data)
                                @if ($currentId !== $data['id'])
                                    {{-- Iniciar una nueva fila para un nuevo movimiento --}}
                                    <tr>
                                        <td>{{ $data['id'] }}</td>
                                        <td>{{ $data['date'] }}</td>
                                        <td>{{ $data['respnsibility'] }}</td>
                                        <td>{{ $data['productiveunit'] }}</td>
                                        <td>{{ $data['warehouse'] }}</td>
                                        <td>
                                            {{-- Crear una columna para los elementos --}}
                                            @foreach ($datas as $innerData)
                                                @if ($innerData['id'] === $data['id'])
                                                    {{ $innerData['inventory'] }}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{-- Crear una columna para las cantidades --}}
                                            @foreach ($datas as $innerData)
                                                @if ($innerData['id'] === $data['id'])
                                                    {{ $innerData['amount'] }}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $data['price'] }}</td>
                                        <td>{{ $data['state'] }}</td>
                                        <td>
                                            {!! Form::open(['route' => ['agrocefa.movements.confirmation', $data['id']], 'method' => 'POST']) !!}
                                            @csrf
                                            {!! Form::hidden('person_id', $data['person_id']) !!}
                                            {!! Form::hidden('element_id', $data['element_id']) !!}
                                            {!! Form::hidden('destination', $data['destination']) !!}
                                            {!! Form::hidden('amount', $data['amount']) !!}
                                            {!! Form::hidden('price', $data['price']) !!}
                                            {!! Form::hidden('lot', $data['lot']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @php $currentId = $data['id']; @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
        <p>No hay movimientos.</p>
@endif
@endsection

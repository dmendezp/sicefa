@extends('agrocefa::layouts.master')

@section('content')

<div class="container" id="containermovements">
    <h2>Bajas</h2>
    <h5>Elementos Vencidos</h5>
    @if (count($inventory) > 0)
    <div class="container my-5">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bodega</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Destino</th>
                                <th>Preio</th>
                                <th>Cantidad</th>
                                <th>Fecha Expiracion</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $currentId = null; @endphp
                            @foreach ($inventory as $item)
                                @if ($currentId !== $item->id)
                                    {{-- Iniciar una nueva fila para un nuevo movimiento --}}
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->productive_unit_warehouse->warehouse->name }}</td>
                                        <td>{{ $item->element->name }}</td>
                                        <td>{{ $item->element->category->name }}</td>
                                        <td>{{ $item->destination }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->amount / $item->element->measurement_unit->conversion_factor}}</td>
                                        <td>{{ $item->expiration_date}}</td>
                                        <td>
                                            {!! Form::open(['route' => ['agrocefa.inventory.movementlow', $item->id], 'method' => 'POST']) !!}
                                            @csrf
                                            {!! Form::hidden('inventoryId', $item->id) !!}
                                            {!! Form::button('Realizar Baja', ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#returnModal'.$item->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @php $currentId = $item->id; @endphp
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
        <p>No hay Bajas pendientes.</p>
@endif
@foreach ($inventory as $item)
    <div class="modal fade" id="returnModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="returnModalLabel{{ $item->id }}">Realizar Baja de {{ $item->element->name}}</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agrocefa.inventory.movementlow', $item->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="returnDescription{{ $item->id }}">Obervacion</label>
                            <textarea class="form-control" id="returnDescription{{ $item['id'] }}" name="observation" required></textarea>
                        </div>
                        <button type="submit" style="margin-top: 10px" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

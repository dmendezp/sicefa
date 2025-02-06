@extends('agrocefa::layouts.master')

@section('content')

<div class="container" id="containermovements">
    <h2>Stock Minimo</h2>
    <h5>Elementos Por Agotarse</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php $currentId = null; @endphp
                            @foreach ($inventory as $item)
                                @if ($currentId !== $item->id)
                                    {{-- Iniciar una nueva fila para un nuevo movimiento --}}
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->productive_unit_warehouse->warehouse->name }}</td>
                                        <td>{{ $item->element->name }}</td>
                                        <td>{{ $item->element->category->name }}</td>
                                        <td>{{ $item->destination }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->amount / $item->element->measurement_unit->conversion_factor }}</td>
                                        <td>{{ $item->expiration_date}}</td>
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
        <p>No Hay Elemenetos por Agotarse.</p>
@endif

@endsection

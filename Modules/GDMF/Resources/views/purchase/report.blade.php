@extends('gdmf::layouts.master')

@section('content')
    <div class="container">
        <div class="card card-menta card-outline shadow">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label>Desde</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                    </div>
                    <div class="col-md-4">
                        <label>Hasta</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-primary">Filtrar</button>
                    </div>
                </form>

                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto total</th>
                            <th>Observación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($compras as $compra)
                            <tr>
                                <td>{{ $compra->purchase_date }}</td>
                                <td>${{ number_format($compra->total_amount, 0, ',', '.') }}</td>
                                <td>{{ $compra->observation }}</td>
                                <td><a href="{{ route('gdmf.academic_coordination.purchase.report_show', $compra->id) }}"
                                        class="btn btn-info btn-sm">Ver Detalle</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay compras registradas en ese rango.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $compras->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

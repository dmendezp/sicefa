@extends('gdmf::layouts.master')

@section('content')
<div class="container">
    <div class="card card-menta card-outline shadow">
        <div class="card-header">
            <a href="{{ route('gdmf.academic_coordination.purchase.report') }}" class="btn btn-secondary mt-2">← Volver al Reporte de Compras</a>
        </div>
        <div class="card-body">
            @if($historial->isEmpty())
                <div class="alert alert-success">
                    No hay registros de fallos de compras.
                </div>
            @else
                <table class="table table-bordered table-striped" id="historyTable">
                    <thead>
                        <tr>
                            <th>Archivo Hash</th>
                            <th>Total Fallos</th>
                            <th>Última Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historial as $registro)
                            <tr>
                                <td><code>{{ $registro->file_hash }}</code></td>
                                <td>{{ $registro->total_failures }}</td>
                                <td>{{ \Carbon\Carbon::parse($registro->last_failed_at)->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('gdmf.academic_coordination.purchase.failure', $registro->file_hash) }}"
                                       class="btn btn-primary btn-sm">
                                        Ver Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#historyTable').DataTable();
    });
</script>
@endsection

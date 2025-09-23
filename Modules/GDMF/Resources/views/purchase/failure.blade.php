@extends('gdmf::layouts.master')

@section('content')
<div class="container">
    <div class="card card-menta card-outline shadow">
        <div class="card-header">
            <p class="mb-0">Archivo Hash: <code>{{ $hash }}</code></p>
            <a href="{{ route('gdmf.academic_coordination.purchase.report') }}" class="btn btn-secondary btn-sm mt-2">← Volver al Reporte de Compras</a>
        </div>
        <div class="card-body">
            @if($fallos->isEmpty())
                <div class="alert alert-success">
                    No se encontraron fallos para este archivo.
                </div>
            @else
                <table class="table table-bordered table-striped" id="failuresTable">
                    <thead>
                        <tr>
                            <th>Instructor</th>
                            <th>Producto</th>
                            <th>UNSPSC</th>
                            <th>Motivo</th>
                            <th>Fecha Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fallos as $f)
                            <tr>
                                <td>{{ $f->instructor_name ?? 'N/A' }}</td>
                                <td>{{ $f->product_name ?? 'N/A' }}</td>
                                <td>{{ $f->unspsc_code ?? 'N/A' }}</td>
                                <td>{{ $f->reason }}</td>
                                <td>{{ $f->created_at->format('Y-m-d H:i') }}</td>
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
        $('#failuresTable').DataTable();
    });
</script>
@endsection

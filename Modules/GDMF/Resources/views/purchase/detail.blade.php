@extends('gdmf::layouts.master')

@section('content')
    <div class="container">
        <div class="card card-menta card-outline shadow">
            <div class="card-body">
                <a href="{{ route('gdmf.academic_coordination.purchase.report') }}" class="btn btn-secondary mb-3">
                    <i class="fas fa-arrow-left"></i> Volver al reporte
                </a>

                <h3>Detalle de Compra del {{ $purchase->purchase_date }}</h3>
                <p><strong>Total:</strong> ${{ number_format($purchase->total_amount, 0, ',', '.') }}</p>
                <p><strong>Observación:</strong> {{ $purchase->observation }}</p>

                <table class="table table-bordered mt-3" id="detalleTable">
                    <thead>
                        <tr>
                            <th>Elemento</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Financiado por</th>
                            <th>Instructor</th>
                            <th>Proyecto Formativo</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->element->name ?? 'N/A' }}</td>
                                <td>{{ $detalle->quantity }}</td>
                                <td>${{ number_format($detalle->unit_price, 0, ',', '.') }}</td>
                                <td>${{ number_format($detalle->subtotal, 0, ',', '.') }}</td>
                                <td>{{ $detalle->financed_by }}</td>
                                <td>{{ optional($detalle->material_request->person)->full_name ?? 'N/A' }}</td>
                                <td>{{ optional($detalle->material_request->training_project)->name ?? 'N/A' }}</td>
                                <td>{{ optional($detalle->material_request->course)->code . ' - ' . optional($detalle->material_request->course->program)->name ?? 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#detalleTable').DataTable({});
        });
    </script>
@endsection

@extends('sigac::layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Consulta de Inventario por Ambiente</h3>

                <!-- Accesos directos -->
                <div>
                    <a href="{{ route('sigac.academic_coordination.environmentcontrol.environment_inventory_movement.entrance.index') }}" class="btn btn-warning mr-2">
                        <i class="nav-icon fas fa-dolly mr-1"></i> Entrada de Inventario
                    </a>
                    <a href="{{ route('sigac.academic_coordination.environmentcontrol.environment_inventory_movement.exit.index') }}" class="btn btn-secondary">
                        <i class="nav-icon fas fa-right-left mr-1"></i> Movimiento de Inventario
                    </a>
                </div>
            </div>

            <div class="form-group">
                <label for="environment">Ambiente:</label>
                {!! Form::select('environment', $environments, null, ['class' => 'form-control', 'id' => 'environment']) !!}
            </div>

            <table class="table table-bordered" id="inventory-table" style="display: none;">
                <thead>
                    <tr>
                        <th>Elemento</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#environment').select2();

        $('#environment').on('change', function() {
            const envId = $(this).val();
            if (envId) {
                $.get('{{ route('sigac.academic_coordination.environmentcontrol.environment_inventory.showInventory') }}', {
                    environment_id: envId
                }, function(data) {
                    const tbody = $('#inventory-table tbody').empty();
                    if (data.length > 0) {
                        data.forEach(function(item) {
                            tbody.append(`
                                <tr>
                                    <td>${item.element.name}</td>
                                    <td>${item.description ?? 'N/A'}</td>
                                    <td>${item.amount}</td>
                                    <td>${item.state}</td>
                                </tr>
                            `);
                        });
                        $('#inventory-table').show();
                    } else {
                        tbody.append(
                            '<tr><td colspan="4">No hay inventario registrado para este ambiente.</td></tr>'
                        );
                        $('#inventory-table').show();
                    }
                });
            } else {
                $('#inventory-table').hide();
            }
        });
    });
</script>
@endpush
@endsection

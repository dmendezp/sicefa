
@if (!empty($inventory) && count($inventory) > 0)
    <div class="card" style="max-width: 100%">
        <div class="card-header">
            {{ trans('agrocefa::inventory.Records') }}
            <button class="btn btn-warning float-end" onclick="redirectTlow()">
                Bajas
                <i class='bx bx-down-arrow-alt icon'></i>
                @if (Session::has('notificationlow') && Session::get('notificationlow') > 0)
                    <span class="notification-badge">{{ Session::get('notificationlow') }}</span>
                @endif
            </button>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover table-sm" style="font-size: 0.9rem;">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>{{ trans('agrocefa::inventory.Element') }}</th>
                        <th>{{ trans('agrocefa::inventory.Category') }}</th>
                        <th>$ {{ trans('agrocefa::inventory.Price') }}</th>
                        <th>{{ trans('agrocefa::inventory.Amount') }}</th>
                        <th>{{ trans('agrocefa::inventory.Destination') }}</th>
                        <th>Stock Minimo</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $shownWarehouses = [];
                    @endphp

                    @foreach ($inventory as $item)
                        @php
                            $measurement_unit = $item->element->measurement_unit->conversion_factor;
                            $currentWarehouse = $item->productive_unit_warehouse->warehouse->name;
                        @endphp

                        @if (!in_array($currentWarehouse, $shownWarehouses))
                            <tr>
                                <td colspan="8" class="warehouse-name table-secondary">
                                    <h7>Bodega : </h7>{{ $currentWarehouse }}
                                </td>
                            </tr>
                            @php
                                $shownWarehouses[] = $currentWarehouse;
                            @endphp
                        @endif

                        <tr>
                            <td >{{ $loop->iteration }}</td>
                            <td >{{ $item->element->name }}</td>
                            <td >{{ $item->element->category->name }}</td>
                            <td >{{ $item->price }}</td>
                            <td >{{ $item->amount / $measurement_unit}}</td>
                            <td >{{ $item->destination }}</td>
                            <td >{{ $item->stock }}</td>
                        </tr>
                    @endforeach

                </tbody>
                
            </table>
        </div>
    </div>
@else
    <!-- Aquí muestras el mensaje cuando no hay registros -->
    <br>
    <p>{{ trans('agrocefa::inventory.NoRecords') }}</p>
@endif
<script>
    $('.btn-inventory-crop').on('click', function(event) {
        var inventoryId = $(this).data('inventory-id');

        // Mostrar SweetAlert para confirmar la eliminación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario de eliminación
                $('#delete-inventory-form-' + inventoryId).submit();
            }
        });
    });

    function redirectTlow() {
        // Redirigir a la otra vista
        window.location.href = "{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.low') }}";
    }
</script>


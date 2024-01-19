
@if (!empty($inventory) && count($inventory) > 0)
    <div class="card">
        <div class="card-header">
            {{ trans('agrocefa::inventory.Records') }}
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('agrocefa::inventory.Element') }}</th>
                        <th>{{ trans('agrocefa::inventory.Category') }}</th>
                        <th>{{ trans('agrocefa::inventory.Destination') }}</th>
                        <th>{{ trans('agrocefa::inventory.Price') }}</th>
                        <th>{{ trans('agrocefa::inventory.Amount') }}</th>
                        <th>Stock</th>
                        @auth
                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.manage'))
                                <th>{{ trans('agrocefa::inventory.Actions') }}</th>
                            @endif
                        @endauth
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
                                <td colspan="8" class="warehouse-name">
                                    <h7>Bodega : </h7>{{ $currentWarehouse }}
                                </td>
                            </tr>
                            @php
                                $shownWarehouses[] = $currentWarehouse;
                            @endphp
                        @endif

                        <tr>
                            <td class="col-1" style="/* width: 10.6px; *//* height: 9px; */">{{ $item->id }}</td>
                            <td class="col-1">{{ $item->element->name }}</td>
                            <td class="col-1">{{ $item->element->category->name }}</td>
                            <td class="col-1">{{ $item->destination }}</td>
                            <td class="col-1">{{ $item->price }}</td>
                            <td class="col-1">{{ $item->amount / $measurement_unit}}</td>
                            <td class="col-1">{{ $item->stock }}</td>

                            @auth
                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.manage'))
                                    <td class="col-1">
                                        <div class="button-group">
                                            <button class="btn btn-primary btn-sm btn-edit-inventory" data-bs-toggle="modal"
                                                data-bs-target="#editarRegistroModal_{{ $item->id }}"
                                                data-inventory-id="{{ $item->id }}"><i
                                                    class='bx bx-edit icon'></i></button>
                                            <button class="btn btn-danger btn-sm btn-inventory-crop" data-inventory-id="{{ $item->id }}">
                                                <i class='bx bx-trash icon'></i>
                                            </button>
                                        </div>
                                    </td>
                                @endif
                            @endauth
                        </tr>

                        {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.destroy', 'id' => $item->id], 'method' => 'POST', 'id' => 'delete-inventory-form-' . $item->id]) !!}
                            @csrf
                            @method('DELETE')
                            <!-- Otros campos ocultos necesarios... -->
                        {!! Form::close() !!}
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

</script>
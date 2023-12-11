@if (!empty($inventory) && count($inventory) > 0)
    <div class="card">
        <div class="card-header">
            {{ trans('agrocefa::inventory.Records') }}
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ trans('agrocefa::inventory.Warehouse') }}</th>
                        <th>{{ trans('agrocefa::inventory.Element') }}</th>
                        <th>{{ trans('agrocefa::inventory.Category') }}</th>
                        <th>{{ trans('agrocefa::inventory.Destination') }}</th>
                        <th>{{ trans('agrocefa::inventory.Description') }}</th>
                        <th>{{ trans('agrocefa::inventory.Price') }}</th>
                        <th>{{ trans('agrocefa::inventory.Amount') }}</th>
                        <th>Stock</th>
                        <th>{{ trans('agrocefa::inventory.Productiondate') }}</th>
                        <th>{{ trans('agrocefa::inventory.lotnumber') }}</th>
                        <th>{{ trans('agrocefa::inventory.expirationdate') }}</th>
                        <th>{{ trans('agrocefa::inventory.state') }}</th>
                        <th>{{ trans('agrocefa::inventory.mark') }}</th>
                        <th>{{ trans('agrocefa::inventory.inventorycode') }}</th>
                        @auth
                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.manage'))
                                <th>{{ trans('agrocefa::inventory.Actions') }}</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventory as $item)
                    {{$measurement_unit = $item->element->measurement_unit->conversion_factor;}}
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->productive_unit_warehouse->warehouse->name }}</td>
                            <td>{{ $item->element->name }}</td>
                            <td>{{ $item->element->category->name }}</td>
                            <td>{{ $item->destination }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->amount / $measurement_unit}}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->production_date }}</td>
                            <td>{{ $item->lot_number }}</td>
                            <td>{{ $item->expiration_date }}</td>
                            <td>{{ $item->state }}</td>
                            <td>{{ $item->mark }}</td>
                            <td>{{ $item->inventory_code }}</td>

                            @auth
                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.manage'))
                                    <td>
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
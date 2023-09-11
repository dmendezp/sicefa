@extends('agrocefa::layouts.master')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Exitoso',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Eliminado',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <h1>Inventario</h1>

    <div class="container_inventory">
        <form method="POST" action="{{ route('agrocefa.inventory.showWarehouseFilter') }}">
            @csrf
            <div class="form-group">
                <label for="category">Selecciona la Categoría:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Todas las categorías</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

        </form>
        <br>
        <div id="filteredResults">
            @include('agrocefa::inventoryPartial')
        </div>
    </div>

    {{-- Modal agregar Registro --}}
    <div class="modal fade" id="crearegistro" tabindex="-1" aria-labelledby="crearegistro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar al inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agrocefa.inventory.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="productive_unit_warehouse_id">Unidad Productiva-Bodega:</label>
                            <select name="productive_unit_warehouse_id" id="productive_unit_warehouse_id"
                                class="form-control" required>
                                <option value="">Seleccionar categoría</option>
                                @foreach ($ProductiveUnitWarehouses as $UnitWarehouse)
                                    <option value="{{ $UnitWarehouse->id }}">{{ $UnitWarehouse->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="element_id">Elemento:</label>
                            <select name="element_id" id="element_id" class="form-control" required>
                                <option value="">Seleccionar elemento</option>
                                @foreach ($elements as $element)
                                    <option value="{{ $element->id }}">{{ $element->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categoría:</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Seleccionar categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="destination">Destino:</label>
                            <select name="destination" id="destination" class="form-control" required>
                                <option value="Producción">Producción</option>
                                <option value="Formación">Formación</option>
                                <!-- Agrega más opciones según tus valores enum -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio:</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Cantidad:</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" id="stock" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de editar --}}
    @foreach ($inventory as $item)
    <div class="modal fade" id="editarRegistroModal_{{ $item->id }}" tabindex="-1"
        aria-labelledby="editarRegistroModal_{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel_{{ $item->id }}">Actualizar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editInventoryForm" action="{{ route('agrocefa.inventory.update', ['id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="productive_unit_warehouse_id_{{ $item->id }}">Unidad Productiva-Bodega:</label>
                            <select name="productive_unit_warehouse_id" id="productive_unit_warehouse_id_{{ $item->id }}"
                                class="form-control" required>
                                @foreach ($ProductiveUnitWarehouses as $UnitWarehouse)
                                    <option value="{{ $UnitWarehouse->id }}">{{ $UnitWarehouse->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="element_id_{{ $item->id }}">Elemento:</label>
                            <select name="element_id" id="element_id_{{ $item->id }}" class="form-control" required>
                                @foreach ($elements as $element)
                                    <option value="{{ $element->id }}" @if($item->element_id == $element->id) selected @endif>{{ $element->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="destination_{{ $item->id }}">Destino:</label>
                            <select name="destination" id="destination" class="form-control" required>
                                <option value="Producción" @if($item->destination == 'Producción') selected @endif>Producción</option>
                                <option value="Formación" @if($item->destination == 'Formación') selected @endif>Formación</option>
                                <!-- Agrega más opciones según tus valores enum -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description_{{ $item->id }}">Descripción:</label>
                            <input type="text" name="description" id="description_{{ $item->id }}" class="form-control" value="{{ $item->description }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id_{{ $item->id }}">Categoría:</label>
                            <select name="category_id" id="category_id_{{ $item->id }}" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price_{{ $item->id }}">Precio:</label>
                            <input type="number" name="price" id="price_{{ $item->id }}" class="form-control" required value="{{ $item->price }}">
                        </div>
                        <div class="form-group">
                            <label for="amount_{{ $item->id }}">Cantidad:</label>
                            <input type="number" name="amount" id="amount_{{ $item->id }}" class="form-control" value="{{ $item->amount }}" required>
                        </div>
                        <div class="form-group">
                            <label for="stock_{{ $item->id }}">Stock:</label>
                            <input type="number" name="stock" id="stock_{{ $item->id }}" class="form-control" value="{{ $item->stock }}" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Actualizar Registro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($inventory as $item)
    <div class="modal fade" id="eliminarinventory_{{ $item->id }}" tabindex="-1"
        aria-labelledby="eliminaractividadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminaractividadLabel">Eliminar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route' => ['agrocefa.inventory.destroy', $item->id], 'method' => 'DELETE']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Cuando cambia la selección de categoría
        $('#category').change(function() {
            var selectedCategoryId = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "{{ route('agrocefa.inventory.showWarehouseFilter') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    category: selectedCategoryId
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#filteredResults').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>

    {{-- Script para editar --}}
    <script>
        $('.btn-edit-inventory').on('click', function(event) {
            var InventoryId = $(this).data('inventory-id'); // Obtener el ID de la especie desde el botón

            // Imprime el ID en la consola para verificar
            console.log('Especie ID:', InventoryId);

            // Obtener los valores de los campos de edición
            var productive_unit_warehouse_id = $('#productive_unit_warehouse_id_' + InventoryId).val();
            var element_id = $('#element_id_' + InventoryId).val();
            var destination = $('#destination_' + InventoryId).val();
            var description = $('#description_' + InventoryId).val();
            var price = $('#price_' + InventoryId).val();
            var amount = $('#amount_' + InventoryId).val();
            var stock = $('#stock_' + InventoryId).val();

            // Llenar los campos del formulario con los datos de la especie
            $('#editInventoryForm_' + InventoryId + ' #productive_unit_warehouse_id').val(productive_unit_warehouse_id);
            $('#editInventoryForm_' + InventoryId + ' #element_id').val(element_id);
            $('#editInventoryForm_' + InventoryId + ' #destination').val(destination);
            $('#editInventoryForm_' + InventoryId + ' #description').val(description);
            $('#editInventoryForm_' + InventoryId + ' #price').val(price);
            $('#editInventoryForm_' + InventoryId + ' #amount').val(amount);
            $('#editInventoryForm_' + InventoryId + ' #stock').val(stock);

            // Construir la URL del formulario con el ID de la especie
            var formAction = '{{ route('agrocefa.inventory.update', ['id' => 'INVENTORY_ID']) }}';
            formAction = formAction.replace('INVENTORY_ID', InventoryId);

            // Actualizar la URL del formulario con el ID de la especie
            $('#editInventoryForm_' + InventoryId).attr('action', formAction);
        });
    </script>


    <style>
        #filter {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .container_inventory {
            margin-right: 50px;
        }
    </style>
@endsection

@extends('agrocefa::layouts.master')

@section('content')
    @if (session('register'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Actualizacion exitosa',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

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
    <h1>{{ trans('agrocefa::inventory.Inventory') }}</h1>
    @auth
        @if (Auth::user()->havePermission('agrocefa.admin.inventory.manage'))
            <div id="espacio" class="btn-group" role="group" aria-label="Botones">
                <button id="register" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#crearegistro">
                    {{ trans('agrocefa::inventory.RecordInventory') }}
                </button>

                <button id="categorys" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearcategoria">
                    {{ trans('agrocefa::inventory.AddCategory') }}
                </button>

                <button id="elements" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearElemento">
                    {{ trans('agrocefa::inventory.AddElement') }}
                </button>

            </div>
        @endif
    @endauth


    <style>
        #espacio {
            margin-bottom: 20px;
        }

        #elements {
            margin-left: 5px;
            border-radius: 5px;
        }

        #categorys {
            margin-left: 5px;
            border-radius: 5px;
        }

        #register {
            margin-left: 5px;
            border-radius: 5px;
        }
    </style>

    <div class="container_inventory">
        <form method="POST" action="{{ route('agrocefa.inventory.showWarehouseFilter') }}">
            @csrf
            <div class="form-group">
                <label for="category">{{ trans('agrocefa::inventory.selectthecategory') }}</label>
                <select name="category" id="category" class="form-control">
                    <option value="">{{ trans('agrocefa::inventory.AllCategories') }}</option>
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

    <!-- Modal para agregar categoría -->
    <div class="modal fade" id="crearcategoria" tabindex="-1" aria-labelledby="crearcategoriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearcategoriaLabel">{{ trans('agrocefa::inventory.AddCategory') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agrocefa.inventory.addCategory') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('agrocefa::inventory.NameCategory') }}:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="kind_of_property">{{ trans('agrocefa::inventory.Type') }}:</label>
                            <select name="kind_of_property" id="kind_of_property" class="form-control" required>
                                <option value="Devolutivo">Devolutivo</option>
                                <option value="Bodega">Bodega</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ trans('agrocefa::inventory.Add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de agregar elemento -->
    <div class="modal fade" id="crearElemento" tabindex="-1" aria-labelledby="crearElementoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearElementoLabel">{{ trans('agrocefa::inventory.AddElement') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addElementForm" action="{{ route('agrocefa.inventory.addElement') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('agrocefa::inventory.Element') }}:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label
                                for="measurement_unit_id">{{ trans('agrocefa::inventory.measurement_unit_id') }}:</label>
                            <select name="measurement_unit_id" id="measurement_unit_id" class="form-control" required>
                                <option value="">{{ trans('agrocefa::inventory.SelectMeasurement') }}</option>
                                @foreach ($measurementUnits as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('agrocefa::inventory.Description') }}:</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kind_of_purchase_id">{{ trans('agrocefa::inventory.PurchaseType') }}:</label>
                            <select name="kind_of_purchase_id" id="kind_of_purchase_id" class="form-control" required>
                                <option value="">{{ trans('agrocefa::inventory.SelectPurchaseType') }}</option>
                                @foreach ($purchaseTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">{{ trans('agrocefa::inventory.Category') }}:</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">{{ trans('agrocefa::inventory.selectthecategory') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('agrocefa::inventory.Price') }}:</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ trans('agrocefa::inventory.Add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal agregar Registro --}}
    <div class="modal fade" id="crearegistro" tabindex="-1" aria-labelledby="crearegistro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">
                        {{ trans('agrocefa::inventory.Addinventory') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agrocefa.inventory.store') }}">
                        @csrf
                        <div class="form-group">
                            <label
                                for="productive_unit_warehouse_id">{{ trans('agrocefa::inventory.ProductiveUnit-Warehouse') }}:</label>
                            <select name="productive_unit_warehouse_id" id="productive_unit_warehouse_id"
                                class="form-control" required>
                                <option value="">{{ trans('agrocefa::inventory.SelectUnit-Warehouse') }}</option>
                                @foreach ($ProductiveUnitWarehouses as $UnitWarehouse)
                                    <option value="{{ $UnitWarehouse->id }}">
                                        {{ $UnitWarehouse->productive_unit->name }} -
                                        {{ $UnitWarehouse->warehouse->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="element_id">{{ trans('agrocefa::inventory.Element') }}:</label>
                            <select name="element_id" id="element_id" class="form-control" required>
                                <option value="">{{ trans('agrocefa::inventory.Select_element') }}</option>
                                @foreach ($elements as $element)
                                    <option value="{{ $element->id }}">{{ $element->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('agrocefa::inventory.Description') }}:</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="destination">{{ trans('agrocefa::inventory.Destination') }}:</label>
                            <select name="destination" id="destination" class="form-control" required>
                                <option value="Producción">Producción</option>
                                <option value="Formación">Formación</option>
                                <!-- Agrega más opciones según tus valores enum -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('agrocefa::inventory.Price') }}:</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">{{ trans('agrocefa::inventory.Amount') }}:</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" id="stock" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ trans('agrocefa::inventory.Add') }}</button>
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
                        <h5 class="modal-title" id="agregarAsistenciaModalLabel_{{ $item->id }}">
                            {{ trans('agrocefa::inventory.Update') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editInventoryForm"
                            action="{{ route('agrocefa.inventory.update', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label
                                    for="productive_unit_warehouse_id_{{ $item->id }}">{{ trans('agrocefa::inventory.ProductiveUnit-Warehouse') }}:</label>
                                <select name="productive_unit_warehouse_id"
                                    id="productive_unit_warehouse_id_{{ $item->id }}" class="form-control" required>
                                    @foreach ($ProductiveUnitWarehouses as $UnitWarehouse)
                                        <option value="{{ $UnitWarehouse->id }}"
                                            @if ($item->productive_unit_warehouse_id == $UnitWarehouse->id)
                                                selected
                                            @endif>
                                            {{ $UnitWarehouse->productive_unit->name }} -
                                            {{ $UnitWarehouse->warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="element_id_{{ $item->id }}">{{ trans('agrocefa::inventory.Element') }}:</label>
                                <select name="element_id" id="element_id_{{ $item->id }}" class="form-control"
                                    required>
                                    @foreach ($elements as $element)
                                        <option value="{{ $element->id }}"
                                            @if ($item->element_id == $element->id) selected @endif>{{ $element->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="destination_{{ $item->id }}">{{ trans('agrocefa::inventory.Destination') }}:</label>
                                <select name="destination" id="destination" class="form-control" required>
                                    <option value="Producción" @if ($item->destination == 'Producción') selected @endif>Producción
                                    </option>
                                    <option value="Formación" @if ($item->destination == 'Formación') selected @endif>Formación
                                    </option>
                                    <!-- Agrega más opciones según tus valores enum -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="description_{{ $item->id }}">{{ trans('agrocefa::inventory.Description') }}:</label>
                                <input type="text" name="description" id="description_{{ $item->id }}"
                                    class="form-control" value="{{ $item->description }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price_{{ $item->id }}">{{ trans('agrocefa::inventory.Price') }}:</label>
                                <input type="number" name="price" id="price_{{ $item->id }}"
                                    class="form-control" required value="{{ $item->price }}">
                            </div>
                            <div class="form-group">
                                <label
                                    for="amount_{{ $item->id }}">{{ trans('agrocefa::inventory.Amount') }}:</label>
                                <input type="number" name="amount" id="amount_{{ $item->id }}"
                                    class="form-control" value="{{ $item->amount }}" required>
                            </div>
                            <div class="form-group">
                                <label for="stock_{{ $item->id }}">Stock:</label>
                                <input type="number" name="stock" id="stock_{{ $item->id }}"
                                    class="form-control" value="{{ $item->stock }}" required>
                            </div>
                            <br>
                            <button type="submit"
                                class="btn btn-primary">{{ trans('agrocefa::inventory.Updaterecord') }}</button>
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
                        <h5 class="modal-title" id="eliminaractividadLabel">
                            {{ trans('agrocefa::inventory.DeleteRecord') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ trans('agrocefa::inventory.Sure?') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('agrocefa::inventory.Cancel') }}</button>
                        {!! Form::open(['route' => ['agrocefa.inventory.destroy', $item->id], 'method' => 'DELETE']) !!}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ trans('agrocefa::inventory.Delete') }}</button>
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
            $('#editInventoryForm_' + InventoryId + ' #productive_unit_warehouse_id').val(
                productive_unit_warehouse_id);
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

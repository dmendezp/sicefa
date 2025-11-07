@extends('agrocefa::layouts.master')

@section('content')

    <h1>{{ trans('agrocefa::inventory.Inventory') }}</h1>
    @auth
        @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.manage'))
            <div id="espacio" class="btn-group" role="group" aria-label="Botones">

                <button id="standcolor" class="btn" data-bs-toggle="modal" data-bs-target="#crearcategoria">
                    {{ trans('agrocefa::inventory.AddCategory') }}
                </button>

                <button id="standcolor" style="margin-left: 10px" class="btn elements" data-bs-toggle="modal" data-bs-target="#crearElemento">
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

        .container_inventory{
            width: 115%;
        }
    </style>

    <div class="container_inventory" style="max-width: 100%; margin-left: 20px;">
        <form method="POST" action="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.showWarehouseFilter') }}">
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
        <form id="filterForm" method="POST" action="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.showWarehouseFilterStock') }}">
            @csrf
            <label for="filtre">Seleccionar filtro:</label>
            <select name="filtre" id="filtre" class="form-control">
                <option value="">Ninguno</option>
                <option value="Stock">Stock Minimo</option>
            </select>
        </form>
        
        <br>
        <div id="filteredResults">
            @include('agrocefa::inventory.InventoryPartial')
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
                    <form method="POST" action="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.category.store') }}">
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
                        <button type="submit" class="btn" id="standcolor">{{ trans('agrocefa::inventory.Add') }}</button>
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
                    <form id="addElementForm" action="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.element.store') }}" method="POST">
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
                        <button type="submit" class="btn" id="standcolor">{{ trans('agrocefa::inventory.Add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('agrocefa::inventory.ModalsInventory')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Cuando cambia la selección de categoría
        $('#category').change(function() {
            var selectedCategoryId = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.showWarehouseFilter') }}",
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

    <script>
        // Cuando cambia la selección de categoría
        $('#filtre').change(function() {
            var selectedfiltre = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.showWarehouseFilterStock') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    filtre: selectedfiltre
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
    {{-- <script>
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
            var state = $('#state_' + InventoryId).val();


            // Llenar los campos del formulario con los datos de la especie
            $('#editInventoryForm_' + InventoryId + ' #productive_unit_warehouse_id').val(
                productive_unit_warehouse_id);
            $('#editInventoryForm_' + InventoryId + ' #element_id').val(element_id);
            $('#editInventoryForm_' + InventoryId + ' #destination').val(destination);
            $('#editInventoryForm_' + InventoryId + ' #description').val(description);
            $('#editInventoryForm_' + InventoryId + ' #price').val(price);
            $('#editInventoryForm_' + InventoryId + ' #amount').val(amount);
            $('#editInventoryForm_' + InventoryId + ' #stock').val(stock);
            $('#editInventoryForm_' + InventoryId + ' #state').val(state);


            // Construir la URL del formulario con el ID de la especie
            var formAction = '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.update', ['id' => 'INVENTORY_ID']) }}';
            formAction = formAction.replace('INVENTORY_ID', InventoryId);

            // Actualizar la URL del formulario con el ID de la especie
            $('#editInventoryForm_' + InventoryId).attr('action', formAction);
        });
    </script> --}}


    <style>
        #filter {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
@endsection

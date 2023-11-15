@extends('agroindustria::layouts.master')
@section('content')
    <div class="card" style="margin-left: 220px; width: 1100px;">
            <div class="card-body">
                    <h1 class="text-center">{{ trans('agroindustria::menu.Inventory') }}</h1>
 <br>
                    <div class="row">

                                <div class="col">
                                        <div class="form-group">

                                            {!! Form::label(
                                                'productunit',
                                                trans('agroindustria::menu.Select Unit'),
                                                ['style' => 'margin-left: 10px;']
                                            ) !!}

                                            {!! Form::select(
                                                'product_unit',
                                                ['' => trans('agroindustria::menu.Select Unit')] + $ppunits->pluck('name', 'id')->toArray(),
                                                old('product_unit'),
                                                ['class' => 'form-control', 'required', 'id' => 'productUnitSelect', 'style' => 'width: 100%;']
                                            ) !!}

                                        </div>
                                </div>

                                <div class="col" style="margin-right: 600px;">
                                            <div class="form-group">
                                            <label for="category" style="margin-left: 10px;">Categorias</label>
                                                <select name="category" id="category" style="width: 100%;" class="form-control">
                                                    <option value="">Seleccione la Categoria</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                </div>
                            
                        </div>
                        
                          <div class="col" style="margin-top: -50px;">
                              <a href="{{ route('cefa.agroindustria.storer.inventory.list') }}" class="btn btn-info float-end mb-2"
                                  style="margin-left: 20px; width: 45px; height: 40px;">
                                  <i class="fa-solid fa-exclamation fa-sm"></i>
                              </a>   
                          </div>
            </div>
            
        <div id="tableresult">
        </div>  
            

       
    </div>













        <br>


    </div>
    </div>


    <br>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var warehouses = {}; // Objeto para almacenar las bodegas
            var newRow;

            // Manejador de eventos para el cambio en el campo "Unidad Productiva"
            $('#productUnitSelect').on('change', function() {
                var selectedProductId = $(this).val(); // Obtener el ID de la unidad productiva seleccionada

                // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                $.ajax({
                    url: '{{ route('cefa.inventory.warehouse') }}',
                    method: 'GET',
                    data: {
                        unit: selectedProductId
                    },
                    success: function(response) {
                        // Manejar la respuesta de la solicitud AJAX aquí
                        console.log('Respuesta de la solicitud AJAX:', response);

                        // Verificar si hay un responsable en la respuesta
                        if (response) {

                            $('#tableresult').html(response);

                        } else {
                            // Mostrar un campo de selección vacío y limpiar el campo "Receptor Responsable"
                            $('#productunit').val('');
                        }
                    },
                    error: function() {
                        // Manejar errores si la solicitud AJAX falla
                        console.error('Error en la solicitud AJAX');
                    }
                });
            });

            // Manejador de eventos para el cambio en el campo de categorías
            $('#category').on('change', function() {
                var selectedCategoryId = $(this).val(); // Obtener el ID de la categoría seleccionada

                // Realizar una solicitud AJAX para obtener el inventario filtrado
                $.ajax({
                    url: '{{ route('cefa.inventory.category') }}', // Ajusta la ruta según tu aplicación
                    method: 'GET',
                    data: {
                        category: selectedCategoryId, // Nuevo: Envía el ID de la categoría seleccionada
                        unit: $('#productUnitSelect')
                        .val() // También envía el ID de la unidad productiva seleccionada
                    },
                    success: function(response) {
                        // Manejar la respuesta de la solicitud AJAX aquí
                        console.log('Respuesta de la solicitud AJAX:', response);

                        // Verificar si hay un responsable en la respuesta
                        if (response) {
                            $('#tableresult').html(response);
                        } else {
                            // Mostrar un campo de selección vacío y limpiar el campo "Receptor Responsable"
                            $('#productunit').val('');
                        }
                    },
                    error: function() {
                        // Manejar errores si la solicitud AJAX falla
                        console.error('Error en la solicitud AJAX');
                    }
                });
            });

        });
    </script>
@section('script')
@endsection
<script>
    /* Script validacion */
    document.addEventListener('DOMContentLoaded', function() {
        var inventoryForm = document.getElementById('inventoryForm');
        inventoryForm.addEventListener('submit', function(event) {
            if (!inventoryForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            inventoryForm.classList.add('was-validated');
        });
    });
</script>
<script>
    function confirmarEliminacion(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto

        if (confirm("¿Estás seguro de que quieres eliminar este elemento de inventario?")) {
            // Si el usuario confirma, entonces procedemos a enviar el formulario
            event.target.submit();
        } else {
            // Si el usuario cancela, no hacemos nada
            // Puedes agregar aquí cualquier otra acción que desees realizar
        }
    }

    // Agregamos un escuchador de eventos para el formulario con la clase 'aa'
    document.addEventListener('DOMContentLoaded', function() {
        var formulario = document.querySelector('.aa');
        formulario.addEventListener('submit', confirmarEliminacion);
    });
</script>


<script>
    //Funcion de deshabilitar selects.
    document.addEventListener('DOMContentLoaded', function() {
        var productiveUnitSelect = document.getElementById('productiveUnit_id');
        var warehousesSelect = document.getElementById('Warehouses_id');

        productiveUnitSelect.addEventListener('change', function() {
            if (this.value !== '') {
                warehousesSelect.disabled = true;
            } else {
                warehousesSelect.disabled = false;
            }
        });

        warehousesSelect.addEventListener('change', function() {
            if (this.value !== '') {
                productiveUnitSelect.disabled = true;
            } else {
                productiveUnitSelect.disabled = false;
            }
        });
    });
</script>
@endsection

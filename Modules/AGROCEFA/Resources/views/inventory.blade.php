@extends('agrocefa::layouts.master')

@section('content')
    <h1>Inventario</h1>
    <div class="container_inventory">
        <form method="POST" action="{{ route('agrocefa.inventory.showWarehouseFilter') }}">
            @csrf
            <div class="form-group">
                <label for="category">Seleccionar Categoría:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Todas las categorías</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <div id="filteredResults">
            @include('agrocefa::inventoryPartial')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Cuando cambia la selección de categoría
        $('#category').change(function () {
            var selectedCategoryId = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "{{ route('agrocefa.inventory.showWarehouseFilter') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    category: selectedCategoryId
                },
                success: function (data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#filteredResults').html(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
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

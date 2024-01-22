@extends('bienestar::layouts.master')
@section('content')
<div class="container">
    @if(count($convocations) > 0)
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($convocations->isNotEmpty())
                <!-- Solo mostrar el card si hay resultados en $convocations -->
                <div class="card shadow">
                    <div class="card-body">
                        @foreach ($convocations as $co)
                        <div class="text-center">
                            <input type="hidden" id="convocation_id" value="{{ $co->id }}">
                            <h1 class="text-center">{{ $co->name }}</h1>
                            <p>{{ $co->description }}</p>
                        </div>
                        <h5>{{ trans('bienestar::menu.Start Date')}}:</h5>
                        <p> {{ $co->start_date }}</p>
                        <h5>{{ trans('bienestar::menu.End Date')}}:</h5>
                        <p> {{ $co->end_date }}</p>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <h1 class="text-center">{{ trans('bienestar::menu.Number Document')}}</h1>
                <div class="card-body">
                    <!-- Agrega el formulario de búsqueda -->
                    <div class="input-group mb-3">
                        <input type="number" name="search" class="form-control" placeholder="Ingrese su número de documento" id="search">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="searchButton"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="divApprentices"></div>
    @else
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center">No hay Convocatorias Disponibles</h2>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    // Definir la función handleSearchResponse primero
    function handleSearchResponse(response) {
        if (response.error) {
            // Mostrar SweetAlert de error con el mensaje personalizado
            showSweetAlert('error', 'Error', response.error, 1500);
        } else {
            // Continuar con el código para manejar los resultados
            console.log(response);
        }
    }
    $(document).on("change", "#search", function() {
        performSearch();
    });

    $(document).on("click", "#searchButton", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        performSearch();
    });

    function performSearch() {
        var miObjeto = new Object();
        miObjeto = $('#search').val();
        var data = JSON.stringify(miObjeto);
        console.log(miObjeto);

        ajaxReplace('divApprentices', '/bienestar/postulations/search', data)
    }
</script>
@endsection
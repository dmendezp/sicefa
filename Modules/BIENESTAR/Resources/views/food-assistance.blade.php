@php
$role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp
@extends('bienestar::layouts.master')

@section('content')
<!-- Main content -->
<div class="container">
    <div class="container-fluid">
        <h1 class="mb-4"> {{ trans('bienestar::menu.Food Assistance')}} <i class="fas fa-pizza-slice"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="number" name="search" class="form-control" placeholder="{{ trans('bienestar::menu.Enter your document number')}}" id="assitance">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="searchButtonassitance"><i class="fas fa-barcode"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($AssistancesFoods) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('bienestar::menu.Number Document')}}</th>
                                    <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                                    <th>{{ trans('bienestar::menu.Code')}}</th>
                                    <th>{{ trans('bienestar::menu.Program')}}</th>
                                    <th>{{ trans('bienestar::menu.Profit and Percentage')}}</th>
                                    <th>{{ trans('bienestar::menu.Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($AssistancesFoods as $result)
                                <tr>
                                    <td>{{ $result->document_number }}</td>
                                    <td>{{ $result->first_name }} {{ $result->first_last_name }} {{ $result->second_last_name }}</td>
                                    <td>{{ $result->code }}</td>
                                    <td>{{ $result->program_name }}</td>
                                    <td>{{ $result->benefit_name }} - {{ $result->porcentege }}</td>
                                    <td>{{ ($result->date_time) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>{{ trans('bienestar::menu.No attendance records have been made today.')}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("change", "#assitance", function() {
        performSearch();
        location.reload();
    });

    $(document).on("click", "#searchButtonassitance", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        performSearch();
    });

    function performSearch() {
        var documentNumber = $('#assitance').val();

        // Realizar la búsqueda mediante AJAX
        axios.post('/bienestar/{{ $role_name }}/food_assistance/search', {
                documentNumber: documentNumber
            })
            .then(function(response) {
                if (response.data.success) {
                    // Mostrar el SweetAlert de éxito
                    showSweetAlert('success', "{{ trans('bienestar::menu.Success!') }}", response.data.success, 2000);
                    // Opcional: Actualizar dinámicamente la interfaz de usuario según sea necesario
                } else if (response.data.error) {
                    // Mostrar el SweetAlert de error
                    showSweetAlert('error', 'Error', response.data.error, 3000);
                } else if (response.data.warning) {
                    // Mostrar el SweetAlert de advertencia
                    showSweetAlert('warning', 'Advertencia', response.data.warning, 2000);
                } else {
                    // Mostrar el SweetAlert de error en caso de problemas inesperados
                    showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to save records.') }}");
                }
            })
            .catch(function(error) {
                // Mostrar SweetAlert con un mensaje de error general
                showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to edit.') }}", 3000);
                console.error('Error en la solicitud AJAX:', error);
            });
    }

    function showSweetAlert(icon, title, text, timer) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: timer
        }).then(function() {
            // Opcional: Recargar la página después del SweetAlert si es necesario
            location.reload();
        });
    }

    function showSweetAlert(icon, title, text, timer) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: timer
        });
    }
</script>

@endsection
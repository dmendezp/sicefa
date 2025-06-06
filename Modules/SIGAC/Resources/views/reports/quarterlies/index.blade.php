@extends('sigac::layouts.master')

@push('head')
    <style>
        /* Aplica posición sticky a ambas filas del encabezado */
        table thead tr:first-child th {
            position: sticky;
            top: 0; /* Para la primera fila */
            background-color: rgb(228, 228, 228);
            z-index: 15;
        }

        table thead tr:nth-child(2) th {
            position: sticky;
            top: 50px; /* Ajusta este valor para que coincida con la altura de la primera fila */
            background-color: rgb(219, 219, 219) !important;
            z-index: 10;
            border-bottom: 2px solid #ddd; /* Mejora la separación visual */
        }

        /* Opcional: Para agregar un borde inferior a la fila sticky y mejorar la visibilidad */
        table thead th {
            border-bottom: 2px solid #ddd;
        }

        /* Asegura que la tabla use todo el ancho disponible */
        table {
            border-collapse: collapse;
            width: 100%;
            overflow-x: auto;
        }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-10">
                    <div class="card-header">
                        <h3 class="card-title">Consultar Trimestralización</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        {!! Form::select('course_id', $courses, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'id' => 'course_id',
                                            'height' => '50px',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divApprentices">
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('#course_id').select2();
    })

    $(document).ready(function() {
        $('#course_id').on('change', function () {
            var course_id = $('#course_id').val();
            var url = {!! json_encode(route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.reports.quartelies.search', ['course_id' => ':course_id'])) !!}.replace(':course_id', course_id);
            
            console.log(url);
            $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.reports.quartelies.search') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        course_id: course_id
                    },
                    success: function(data) {
                        // Actualizar el contenedor con los resultados filtrados
                        console.log(data);
                        $('#divApprentices').html(data);
                        $('#table').DataTable({

                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
        });

        
    });
</script>



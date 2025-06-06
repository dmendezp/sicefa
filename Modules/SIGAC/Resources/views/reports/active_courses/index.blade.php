@extends('sigac::layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-10">
                <div class="card-header">
                    <h3 class="card-title">Consultar Fichas Activas</h3>
                </div>
                <div class="card-body">
                    <div class="form_search" id="form_search">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    {!! Form::select('quarterlie', 
                                    [
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                        '5' => '5',
                                        '6' => '6',
                                        '7' => '7'
                                    ],  null, ['class' => 'form-control', 'id' => 'quarterlie', 'height' => '50px', 'placeholder' => 'Seleccione trimestre actual de formación']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="divCourses"> 
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        var quarterlie = $('#quarterlie').val();

        // Verificar si se seleccionó un trimestre (quarterlie no está vacío)
        if (quarterlie == '') {
            // Si no hay trimestre seleccionado, cargar todos los cursos activos
            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.reports.active_courses.search') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                    // No enviar 'quarterlie' para obtener todos los cursos
                },
                success: function(data) {
                    // Actualizar el contenedor con todos los cursos activos
                    $('#divCourses').html(data);
                    $('#table').DataTable({});
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } 
        
        $('#quarterlie').on('change', function(){
            var quarterlie = $('#quarterlie').val();
            // Escuchar el cambio en el checkbox
            
            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.reports.active_courses.search') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    quarterlie: quarterlie
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#divCourses').html(data);
                    $('#table').DataTable({});
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

</script>
@endpush

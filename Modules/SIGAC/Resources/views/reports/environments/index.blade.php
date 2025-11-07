@extends('sigac::layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-10">
                <div class="card-header">
                    <h3 class="card-title">Consultar Datos de Instructores</h3>
                </div>
                <div class="card-body">
                    <div class="form_search" id="form_search">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    {!! Form::date('day', now(), ['class' => 'form-control', 'id' => 'day', 'height' => '50px']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="divEnvironments">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var nowDay = $('#day').val();
        // Escuchar el cambio en el checkbox
        
        $.ajax({
            type: 'POST',
            url: "{{ route('sigac.academic_coordination.reports.environments.search') }}",
            data: {
                _token: "{{ csrf_token() }}",
                day: nowDay
            },
            success: function(data) {
                // Actualizar el contenedor con los resultados filtrados
                $('#divEnvironments').html(data);
                $('#table').DataTable({});
                $('#table_available').DataTable({});

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $('#day').on('change', function () {
            var day = $('#day').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.reports.environments.search') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    day: day
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#divEnvironments').html(data);
                    $('#table').DataTable({});
                    $('#table_available').DataTable({});

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endpush

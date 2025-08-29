@extends('sigac::layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-10">
                <div class="card-header">
                    <h3 class="card-title">Consultar Disponibilidad de ambientes</h3>
                </div>
                <div class="card-body">
                    <div class="form_search" id="form_search">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    {!! Form::date('day', now(), ['class' => 'form-control', 'id' => 'day', 'height' => '50px']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::select('state', ['' => 'Seleccione un estado', 'Disponible' => 'Disponible', 'NoDisponible' => 'No Disponible'], null, ['class' => 'form-control', 'id' => 'state', 'height' => '50px']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="divEnvironmentsAvailables">
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var nowDay = $('#day').val();
        $('#state').on('change', function () {
            var state = $('#state').val();

            if (state == 'Disponible') { 
                
                $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.academic_coordination.reports.environments.search') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        day: nowDay
                    },
                    success: function(data) {
                        // Actualizar el contenedor con los resultados filtrados
                        console.log(data);
                        $('#divEnvironmentsAvailables').html(data);
                        $('.notAvailable').hide(); 
                        $('#table').DataTable({
                            "ordering": false
                        });
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
                            $('#divEnvironmentsAvailables').html(data);
                            $('.notAvailable').hide(); 
                            $('#table').DataTable({
                                "ordering": false
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
                   
            }else if(state == 'NoDisponible'){
                
                $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.academic_coordination.reports.environments.search') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        day: nowDay
                    },
                    success: function(data) {
                        // Actualizar el contenedor con los resultados filtrados
                        console.log(data);
                        $('#divEnvironmentsAvailables').html(data);
                        $('.available').hide();    
                        $('#tableNotAvailable').DataTable({});
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
                            $('#divEnvironmentsAvailables').html(data);
                            $('.available').hide();    
                            $('#tableNotAvailable').DataTable({});
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
                
            }
        });
    });
</script>
@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio competencia --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Programas</h3>
                            <a class="btn btn-outline-secondary float-right ml-1" href="{{ route('sigac.academic_coordination.programming.programs.export') }}">Exportar Programas y Titulaciones</a>
                            <a class="btn btn-outline-secondary float-right ml-1" href="{{ route('sigac.academic_coordination.programming.programs.load.create') }}">Cargar Programas</a>
                        </div>
                        <div class="card-body">
                        @include('sigac::programming.parameters.competences.table_programs')
                    </div>
                </div>
                </div> {{-- Fin competencia --}}
                <div class="col-md-6">
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Profesiones</h3>
                        </div>
                        <div class="card-body">
                            @include('sigac::programming.parameters.professions.table')
                        </div>
                    </div>
                </div> {{-- Fin --}}
                <div class="col-md-6">
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('sigac::programming.External_Activities')}}</h3>
                        </div>
                        <div class="card-body">
                            @include('sigac::programming.parameters.external_activities.table')
                        </div>
                    </div>
                </div> {{-- Fin --}}
                <div class="col-md-12">
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('sigac::programming.Special_Programs')}}</h3>
                        </div>
                        <div class="card-body">
                            @include('sigac::programming.parameters.special_program.table')
                        </div>
                    </div>
                </div> {{-- Fin --}}
            </div>
        </div>
    </div>

    @endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#profession').DataTable({

        });
        $('#external_activities').DataTable({

        });
        $('#special_program').DataTable({

        });
        var table = $('#programs').DataTable({
            "processing": true,
            "serverSide": false,
            "ajax": "{{ route('sigac.academic_coordination.programming.programs.search') }}",
            "columns": [{
                    "data": 'DT_RowIndex',
                    "name": 'DT_RowIndex'
                },
                {
                    "data": 'name',
                    "name": 'name'
                },
                {
                    "data": 'quarter_number',
                    "name": 'quarter_number'
                },
                {
                    "data": 'knowledge_network.name',
                    "name": 'knowledge_network'
                },
                {
                    "data": 'program_type',
                    "name": 'program_type'
                },
                {
                    "data": 'action',
                    "name": 'action',
                    "orderable": true,
                    "searchable": true,
                    "fixedHeader": true
                }
            ],
            "columnDefs": [
                {
                    "targets": "_all", // Aplicar a todas las columnas
                    "className": "text-center", // Agregar la clase text-center
                }
            ]
        });
        
    });

    $("#addProfession").on("hidden.bs.modal", function() {
        /* Modal content is removed when the modal is closed */
        $("#modal-content").empty();
    });

    function mayus(e) {
        /* Convert the content of a field to uppercase */
        e.value = e.value.toUpperCase();
    }

    
</script>


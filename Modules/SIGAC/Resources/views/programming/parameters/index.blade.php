@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio competencia --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Competencia</h3>
                        </div>
                        <div class="card-body">
                        @include('sigac::programming.parameters.competences.table')
                    </div>
                </div>
                </div> {{-- Fin competencia --}}

                <div class="col-md-12"> 
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Resultados</h3>
                        </div>
                        <div class="card-body">
                            @include('sigac::programming.parameters.learning_outcomes.table')
                        </div>
                    </div>
                </div> {{-- Fin  --}}
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


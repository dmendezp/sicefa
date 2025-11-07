@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio Trimestralización --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Proyecto Formativo</h3>
                        </div>
                        <div class="card-body">
                        @include('sigac::curriculum_planning.training_project.table')
                    </div>
                </div>
                </div> {{-- Fin Trimestralización --}}

            </div>
        </div>
    </div>

    @endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#quarterlies').DataTable({
        });
        
    });

    function mayus(e) {
        /* Convert the content of a field to uppercase */
        e.value = e.value.toUpperCase();
    }
</script>


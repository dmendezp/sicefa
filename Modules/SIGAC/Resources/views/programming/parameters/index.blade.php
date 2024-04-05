@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6"> {{-- Inicio competencia --}}
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Competencia</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    <table id="competences" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="">
                                                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </b>
                                                        </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin competencia --}}
                <div class="col-md-6"> 
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Resultados</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    <table id="learning_customes" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nombre</th>
                                                <th>Descripción</th>
                                                <th class="text-center">
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="">
                                                        <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </b>
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin  --}}
                <div class="col-md-12">
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Profesiones</h3>
                        </div>
                        <div class="card-body">
                            @include('sigac::programming.parameters.professions.table')
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
        $('#competences').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });
        $('#learning_customes').DataTable({
            columnDefs: [
                { orderable: false, targets: 3 }
            ]
        });
        $('#profession').DataTable({});
        
    });

    @if (Session::get('message_config'))
        $('html, body').animate({
            /* Move the page to the previously selected configuration */
            scrollTop: $("#{{ Session::get('card') }}").offset().top
        }, 1000);
        /* Show the message */
        @if (Session::get('icon') == 'success')
            toastr.success("{{ Session::get('message_config') }}");
        @elseif (Session::get('icon') == 'error')
            toastr.error("{{ Session::get('message_config') }}");
        @endif
    @endif

    function ajaxAction(route) {
        /* Ajax to show content modal to add event */
        $('#loader-message').text('Cargando contenido...'); /* Add content to loader */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                method: "get",
                url: route,
                data: {}
            })
            .done(function(html) {
                $("#modal-content").html(html);
            });
    }

    $("#addProfession").on("hidden.bs.modal", function() {
        /* Modal content is removed when the modal is closed */
        $("#modal-content").empty();
    });

    function mayus(e) {
        /* Convert the content of a field to uppercase */
        e.value = e.value.toUpperCase();
    }
</script>


@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Contratistas</h3>
                    </div>
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="table_contractors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Documento</th>
                                        <th class="text-center">Nombre</th>
                                        <th>Tipo Empleado</th>
                                        <th>Tipo Contrato</th>
                                        <th>Fecha</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contractors as $contractor)
                                    <tr>
                                        
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $contractor->person->document_number }}</td>
                                        <td class="text-center">{{ $contractor->person->fullname }}</td>
                                        <td>{{ $contractor->employee_type->name }}</td>
                                        <td>{{ $contractor->contractor_type->name }}</td>
                                        <td>{{ $contractor->contract_start_date }}</td>
                                        <td
                                         class="text-center">
                                            <a id="actions" data-path="admin/role" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.people.contractors.show', $contractor) }}')">
                                                <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Ver">
                                                    <i class="fas fa-eye text-warning"></i>
                                                </b>
                                              </a>  
                                        </td>
                                        
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- General modal -->
    <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 850px;" id="modal-content"></div>
        </div>
    </div>
    <div id="loader" style="display: none;"> {{-- Loader modal --}}
        <div class="modal-body text-center" id="modal-loader">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div><br>
            <b id="loader-message"></b>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $("#table_contractors").DataTable({});
        });

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

        // Vaciar el contenido del modal cuando sea cerrado
        $("#generalModal").on("hidden.bs.modal", function() {
            $("#modal-content").empty();
        });
    </script>
@endsection

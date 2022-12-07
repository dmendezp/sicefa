@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">Productores</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-10 mx-auto">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ $view['titleView'] }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="table-producers" class="table table-bordered table-striped table-sm dtr-inline">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">#</th>
                                                <th class="align-middle text-center">Productor</th>
                                                <th class="text-center" >
                                                    <a href="{{ route('cpd.admin.producer.create') }}" class="btn btn-primary py-0 px-1 btn-sm" data-toggle='tooltip' data-placement="top" title="Registrar productor">
                                                        <i class="fas fa-plus-circle"></i>
                                                        Registrar
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($producers as $producer)
                                                <tr>
                                                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $producer->name }}</td>
                                                    <td class="align-middle text-center">
                                                        <a href="#" class="text-success"  data-toggle='tooltip' data-placement="top" title="Actualizar productor">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('cpd.admin.study.delete') }}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar monitoreo">
                                                                <i class="far fa-trash-alt"></i>
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
                </div> <!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#table-producers').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                lengthMenu: [
                    [5, 10, 20, -1 ],
                    ['5', '10', '20', 'Todas' ]
                ],
                columnDefs: [
                    { orderable: false, targets: 2 }
                ]
            })
        });

        function ajaxAction(route){ /* Ajax to show content modal to add event */
            $('#loader-message').text('Cargando contenido...'); /* Add content to loader */
            $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
            $.ajaxSetup({
                headers:     {
                    'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "get",
                url: route,
                data: {}
            })
            .done(function(html){
                $("#modal-content").html(html);
            });
        }

        $("#generalModal").on("hidden.bs.modal", function () { /* Modal content is removed when the modal is closed */
            $("#modal-content").empty();
        });
    </script>
@endsection

@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                {{-- Aqui inicia la tabla de Categorías --}}
                <div class="col-md-6" id="card-categories">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Categorías</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableCategory" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tipo de propiedad</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.category.create') }}')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $c)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $c->name }}</td>
                                                <td>{{ $c->kind_of_property }}</td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.category.update') }}/{{ $c->id }}')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.category.destroy') }}/{{ $c->id }}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Aqui finaliza la tabla categorías --}}

                {{-- Aqui inicia la tabla de Tipos de Compra --}}
                <div class="col-md-6" id="card-kind_of_purchases">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tipos de Compra</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableKindOfPurchase" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.kindOfPurchase.create') }}')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kindOfPurchase as $k)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $k->name }}</td>
                                                <td>{{ $k->description }}</td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.kindOfPurchase.update') }}/{{ $k->id }}')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.kindOfPurchase.destroy') }}/{{ $k->id }}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Aqui finaliza la tabla Tipos de Compra --}}

                {{-- Aqui finaliza la tabla unidades de medida --}}
                <div class="col-md-6"  id="card-measurement_units">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Unidades de Medida</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableMeasurementUnit" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Abreviación</th>
                                            <th>Medida mínima</th>
                                            <th>Factor de converción</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.measurementUnit.create') }}')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($measurementUnit as $m)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $m->name }}</td>
                                                <td>{{ $m->abbreviation }}</td>
                                                <td>{{ $m->minimum_unit_measure }}</td>
                                                <td>{{ $m->conversion_factor }}</td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.measurementUnit.edit', $m->id)}}')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.measurementUnit.delete', $m->id)}}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Aqui finaliza la tabla unidades de medida --}}

                {{-- Aqui finaliza la tabla unidades de medida --}}
                <div class="col-md-6"  id="card-movement_type">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tipos de movimiento</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableMovementType" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nombre</th>
                                            <th class="text-center">Consecutivo</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.movement_type.create') }}')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>    
                                    <tbody>
                                        @foreach ($movement_types as $mt)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $mt->name }}</td>
                                                <td class="text-center">{{ $mt->consecutive }}</td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.movement_type.edit', $mt->id)}}')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.admin.inventory.parameters.movement_type.delete', $mt->id)}}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Aqui finaliza la tabla unidades de medida --}}
            </div>
        </div>
    </div>

    <!-- General modal -->
    <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content"></div>
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
        @if (Session::get('message_parameter'))
            $('html, body').animate({
                /* Move the page to the previously selected configuration */
                scrollTop: $("#{{ Session::get('card') }}").offset().top
            }, 1000);
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_parameter') }}");
            @elseif (Session::get('icon') == 'error')
                toastr.error("{{ Session::get('message_parameter') }}");
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

        // Vaciar el contenido del modal cuando sea cerrado
        $("#generalModal").on("hidden.bs.modal", function() {
            $("#modal-content").empty();
        });

    </script>
<script>
    $(document).ready(function () { /* Initialización of Datatables ---Category */
        $('#tableCategory').DataTable({
            // opciones de configuración para la tabla 1
        });

        $('#tableMeasurementUnit').DataTable({
            // opciones de configuración para la tabla 2
        });

        $('#tableKindOfPurchase').DataTable({
            // opciones de configuración para la tabla 3
        });

        $('#tableMovementType').DataTable({
            // opciones de configuración para la tabla 4
        });
    });
</script>
@endsection

@extends('sica::layouts.master')
@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-auto">
                                <h4>{{trans('sica::menu.Productive Units')}}</h4>
                            </div>
                            <div class="col-md">
                                <a href="{{ route('sica.'.$role_name.'.units.productive_units.environment_pus.index') }}" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Relación de ambientes y unidades productivas
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mtop16">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="productive_units_table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>{{trans('sica::menu.Name')}}</th>
                                            <th>{{trans('sica::menu.Description')}}</th>
                                            <th class="text-center">Icono</th>
                                            <th>Líder</th>
                                            <th class="text-center">Sector</th>
                                            <th class="text-center">Finca</th>
                                            <th class="col-2">{{trans('sica::menu.Actions')}}
                                                <a class="mx-3" href="{{ route('sica.'.$role_name.'.units.productive_unit.create') }}">
                                                    <b class="text-success" title="Registrar Trimestre">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productive_units as $pu)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $pu->name }}</td>
                                                <td>{{ $pu->description }}</td>
                                                <td class="text-center">
                                                    <h1><i class="{{ $pu->icon }}"></i></h1>
                                                </td>
                                                <td>{{ $pu->person->full_name }}</td>
                                                <td class="text-center">{{ $pu->sector->name }}</td>
                                                <td class="text-center">{{ $pu->farm->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sica.'.$role_name.'.units.productive_unit.edit', $pu) }}" data-toggle='tooltip' data-placement="top" title="Actualizar unidad productiva">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.units.productive_unit.delete', $pu->id) }}')">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar unidad productiva">
                                                            <i class="fas fa-trash-alt"></i>
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
    </div>
    <!-- General modal -->
  <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
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
        $(document).ready(function() {
            $('#productive_units_table').DataTable({});
        });
    </script>
    <script>
        @if (Session::get('message_productive_unit'))
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message_productive_unit') }}");
            @elseif (Session::get('icon') == 'error')
                toastr.error("{{ Session::get('message_productive_unit') }}");
            @endif
        @endif
      
        function ajaxAction(route) {
            /* Ajax to show content modal to add line */
            $('#loader-message').text("{{ trans('sica::menu.Loading Content') }}"); /* Add content to loader */
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

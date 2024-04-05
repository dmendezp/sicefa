@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="d-flex justify-content-center">
        <div class="card card-orange card-outline shadow col-md-12">
          <div class="card-header">
            <h3 class="card-title">{{ trans('sica::menu.Quarters') }}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="mtop16">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('sica::menu.Quarter') }}</th>
                    <th>{{ trans('sica::menu.Start Date') }}</th>
                    <th>{{ trans('sica::menu.End Date') }}</th>
                    <th class="text-center">{{ trans('sica::menu.Actions') }}
                      <a class="mx-3" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.quarters.create') }}')">
                          <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar Trimestre">
                              <i class="fas fa-plus-circle"></i>
                          </b>
                      </a>
                  </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($quarters as $q)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $q->name }}</td>
                    <td>{{ $q->start_date }}</td>
                    <td>{{ $q->end_date }}</td>
                    <td class="text-center">
                      <div class="opts"> 
                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.quarters.edit', $q->id) }}')">
                          <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar Trimestre">
                              <i class="fas fa-edit"></i>
                          </b>
                        </a>
  
                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.'.$role_name.'.academy.quarters.delete', $q->id) }}')">
                          <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Trimestre">
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
          <!-- Timelime example  -->
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  
  <script>
    @if (Session::get('message_quarter'))
        /* Show the message */
        @if (Session::get('icon') == 'success')
            toastr.success("{{ Session::get('message_quarter') }}");
        @elseif (Session::get('icon') == 'error')
            toastr.error("{{ Session::get('message_quarter') }}");
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

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Asociación de unidades productivas y bodegas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.pu_warehouses.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Unidad productiva:</label>
                                        <select name="productive_unit_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($productive_units as $pu)
                                                <option value="{{ $pu->id }}">{{ $pu->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bodega:</label>
                                        <select name="warehouse_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            @foreach ($warehouses as $w)
                                                <option value="{{ $w->id }}">{{ $w->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Sincronizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Unidad productiva</th>
                                                <th>Bodega</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $previous_pu_id = null;
                                        @endphp
                                        @foreach ($productive_unit_warehouses as $puw)
                                            @if ($previous_pu_id !== $puw->productive_unit_id)
                                                <tr>
                                                    <td  style="vertical-align: middle"  rowspan="{{ $productive_unit_warehouses->where('productive_unit_id', $puw->productive_unit_id)->count() }}">
                                                        {{ $puw->productive_unit->name }}
                                                    </td>
                                                @php
                                                    $rowspanCount = $productive_unit_warehouses->where('productive_unit_id', $puw->productive_unit_id)->count();
                                                @endphp
                                            @else
                                                <tr>
                                            @endif
                                                <td>{{ $puw->warehouse->name }}</td>
                                                <td class="text-center">
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.pu_warehouses.delete', $puw->id) }}')">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar asociación">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $previous_pu_id = $puw->productive_unit_id;
                                            @endphp
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
  @if (Session::get('message_puw'))
      /* Show the message */
      @if (Session::get('icon') == 'success')
          toastr.success("{{ Session::get('message_puw') }}");
      @elseif (Session::get('icon') == 'error')
          toastr.error("{{ Session::get('message_puw') }}");
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


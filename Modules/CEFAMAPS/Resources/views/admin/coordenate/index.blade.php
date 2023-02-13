@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i>{{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-arrows-to-circle"></i> {{ trans('cefamaps::coordinates.Coordinates') }}</a></li>

@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-lightblue card-outline">
          <div class="card-header">
            <h3 class="m-0">{{ trans('cefamaps::coordinates.Coordinates') }}</h3>
          </div>
          <div class="card-body">
            <div class="content">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>{{ trans('cefamaps::environment.Length') }}</th>
                    <th>{{ trans('cefamaps::environment.Latitude') }}</th>
                    <th>{{trans('cefamaps::environment.Environment')}}</th>
                    <th>
                      <a class="btn btn-success" href="{{ route('cefamaps.admin.config.coordenate.add') }}">
                        <i class="fa-solid fa-square-plus"></i>
                      </a>
                    </th>
                  </tr>
                  @foreach($coor as $c)
                  <tbody>
                    <tr>
                      <td>{{$c->id}}</td>
                      <td>{{$c->length}}</td>
                      <td>{{$c->latitude}}</td>
                      <td>{{$c->environment_id}}</td>
                      <td>
                        <a class="btn btn-warning" href="{{url('/cefamaps/coordenate/edit/'.$c->id)}}">
                          <i class="fas fa-map-signs"></i>
                        </a>
                        <a class="btn btn-danger delete-coordenate" href="#" type="submit" data-action="delete" data-object="{{ $c->id }}" data-path="/cefamaps/coordenate/delete">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

  <script type="text/javascript">
    /*
      Para poder eliminar un Environment
    */
    $(document).ready(function(){
      $(document).on("click", ".delete-coordenate", function() {
        var id = $(this).data('object');
        var url = "{{ url('/cefamaps/coordenate/delete/') }}/"+id;
        Swal.fire({
          title: '{{ trans("cefamaps::menu.Are You Sure") }} {{ trans("cefamaps::menu.To") }} {{ trans("cefamaps::menu.Delete") }}'+id,
          text: "Aca no sirve el control Z",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed){
            window.location.href=url
          }
        })
      })
    })
  </script>

@endsection
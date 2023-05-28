@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.unit.index') }}"><i class="fas fa-solid fa-mountain-sun"></i> {{ trans('cefamaps::unit.Units') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::unit.Units') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::unit.Name') }}</th>
                      <th>{{ trans('cefamaps::unit.Person in charge') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</th>
                      <th>{{ trans('cefamaps::sector.Sector') }}</th>
                      <th>{{ trans('cefamaps::unit.Farm') }}</th>
                      <th>{{ trans('cefamaps::unit.Description') }}</th>
                      <th>{{ trans('cefamaps::unit.Icon') }}</th>
                      <th>
                        <a href="{{ route('cefamaps.admin.config.unit.add')}}" class="btn btn-success">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($unit as $u)
                    <tr>
                      <td>{{$u->id}}</td>
                      <td>{{$u->name}}</td>
                      <td>{{$u->person->full_name}}</td>
                      <td>{{$u->sector->name}}</td>
                      <td>{{$u->farm->name}}</td>
                      <td>{{$u->description}}</td>
                      <td>
                        <i class="{{$u->icon}}"></i>
                      </td>
                      <td>
                        <a href="{{url('/cefamaps/unit/edit/'.$u->id)}}" class="btn btn-warning">
                          <i class="fas fa-map-signs"></i>
                        </a>
                        <a class="btn btn-danger delete-unit" href="#" type="submit" data-action="delete" data-object="{{ $u->id }}" data-path="/cefamaps/unit/delete/">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>  
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::unit.Name') }}</th>
                      <th>{{ trans('cefamaps::unit.Person in charge') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</th>
                      <th>{{ trans('cefamaps::sector.Sector') }}</th>
                      <th>{{ trans('cefamaps::unit.Farm') }}</th>
                      <th>{{ trans('cefamaps::unit.Description') }}</th>
                      <th>{{ trans('cefamaps::unit.Icon') }}</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

@endsection

@section('script')

  <script>
    $(document).ready(function(){
      $(document).on("click", ".delete-unit", function() {
        var id = $(this).data('object');
        var url = "{{ url('/cefamaps/unit/delete/') }}/"+id;
        Swal.fire({
          title: 'Estas seguro de elimar',
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

  <script>
  $(document).ready(function () {
    $('#example1').DataTable({
      order: [[3, 'desc']],
    });
  });
  </script>

@endsection

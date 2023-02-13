@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-tractor"></i> {{ trans('cefamaps::farm.Farm') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::farm.Farm') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::farm.Name') }}</th>
                      <th>{{ trans('cefamaps::farm.Description') }}</th>
                      <th>{{ trans('cefamaps::farm.Area') }}</th>
                      <th>{{ trans('cefamaps::farm.Person in charge of the') }} {{ trans('cefamaps::farm.Farm') }}</th>
                      <th>{{ trans('cefamaps::farm.Municipality') }}</th>
                      <th>
                        <a href="{{ route('cefamaps.admin.config.farm.add')}}" class="btn btn-success">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  @foreach($farm as $f)
                  <tbody>
                    <tr>
                      <td>{{$f->id}}</td>
                      <td>{{$f->name}}</td>
                      <td>{{$f->description}}</td>
                      <td>{{$f->area}}</td>
                      <td>{{$f->person_id}}</td>
                      <td>{{$f->municipality_id}}

                      </td>
                      <td>
                        <a href="{{ url('/cefamaps/farm/edit/'.$f->id) }}" class="btn btn-warning">
                          <i class="fas fa-map-signs"></i>
                        </a>
                        <a class="btn btn-danger delete-farm" href="#" type="submit" data-action="delete" data-object="{{ $f->id }}" data-path="/cefamaps/farm/delete/">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  <tfoot>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::farm.Name') }}</th>
                      <th>{{ trans('cefamaps::farm.Description') }}</th>
                      <th>{{ trans('cefamaps::farm.Area') }}</th>
                      <th>{{ trans('cefamaps::farm.Person in charge of the') }} {{ trans('cefamaps::farm.Farm') }}</th>
                      <th>{{ trans('cefamaps::farm.Municipality') }}</th>
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
      $(document).on("click", ".delete-farm", function() {
        var id = $(this).data('object');
        var url = "{{ url('/cefamaps/farm/delete/') }}/"+id;
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

@extends('ganaderia::layouts.master')

@section('style')
@endsection

@section('breadcrumb')
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('ganaderia::leader.Race') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('ganaderia::leader.Name') }}</th>
                      <th>
                        <a href="{{ route('ganaderia.admin.leader.race.add') }}" class="btn btn-success">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($race as $r)
                      <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->name }}</td>
                        <td>
                          <a href="{{url('/ganaderia/admin/animal/race/edit/'.$r->id)}}" class="btn btn-warning">
                            <i class="fas fa-map-signs"></i>
                          </a>
                          <a class="btn btn-danger delete-race" href="#" type="submit" data-action="delete" data-object="{{ $r->id }}" data-path="/ganaderia/admin/animal/race/delete/">
                            <i class="fa-solid fa-trash"></i>
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

@endsection

@section('script')

  <script>
  $(document).ready(function () {
    $('#example1').DataTable({
      order: [[3, 'desc']],
    });
  });
  </script>

  <script>
    $(document).ready(function(){
      $(document).on("click", ".delete-race", function() {
        var id = $(this).data('object');
        var url = $(this).data('path')+id;
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

@endsection
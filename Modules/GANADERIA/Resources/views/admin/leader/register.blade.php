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
              <h5 class="m-0">{{ trans('ganaderia::leader.Register') }}</h5>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Raza</th>
                      <th>Madre</th>
                      <th>Peso</th>
                      <th>Sexo</th>
                      <th>color</th>
                      <th>Fecha de Nacimiento</th>
                      <th>
                        <a class="btn btn-success" href="{{ route('ganaderia.admin.leader.register.add') }}">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($animal as $a)
                      <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->code }}</td>
                        <td>{{ $a->races->name }}</td>
                        <td>{{ $a->mother }}</td>
                        <td>{{ $a->weight }}</td>
                        <td>{{ $a->sex }}</td>
                        <td>{{ $a->color }}</td>
                        <td>{{ $a->date_of_birth }}</td>
                        <td>
                          <a href="{{ url('/ganaderia/admin/animal/edit/'.$a->id) }}" class="btn btn-warning">
                            <i class="fas fa-map-signs"></i>
                          </a>
                          <a class="btn btn-danger delete-animal" href="#" type="submit" data-action="delete" data-object="{{ $a->id }}" data-path="/ganaderia/admin/animal/delete">
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
      $(document).on("click", ".delete-animal", function() {
        var id = $(this).data('object');
        var url = "{{ url('/ganaderia/admin/animal/delete/') }}/"+id;
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
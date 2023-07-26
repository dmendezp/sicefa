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
              <h3 class="m-0">{{ trans('ganaderia::vet.Register') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>Inventario</th>
                      <th>Animal</th>
                      <th>Fecha del tratamiento</th>
                      <th>Dosis</th>
                      <th>Nombre de la medicina</th>
                      <th>observacion</th>
                      <th>Persona que se la aplico</th>
                      <th>
                        <a href="{{ route('ganaderia.admin.vet.register.add') }}" class="btn btn-success">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($treat as $t)
                      <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->inventory->description }}</td>
                        <td>{{ $t->animal->name }}</td>
                        <td>{{ $t->date_treatment }}</td>
                        <td>{{ $t->dose }}</td>
                        <td>{{ $t->name_medicine }}</td>
                        <td>{{ $t->observations }}</td>
                        <td>{{ $t->person->full_name }}</td>
                        <td>
                          <a href="{{url('/ganaderia/admin/vet/edit/'.$t->id)}}" class="btn btn-warning">
                            <i class="fas fa-map-signs"></i>
                          </a>
                          <a class="btn btn-danger delete-race" href="#" type="submit" data-action="delete" data-object="{{ $t->id }}" data-path="/ganaderia/admin/animal/race/delete/">
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
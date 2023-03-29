@extends('ganaderia::layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">REPRODUCCION</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Madre</th>
                      <th>Padre </th>
                      <th>Tipo de Fertilizacion</th>
                      <th>Fecha</th>
                    
                      <th>
                        <a href="{{ route('ganaderia.admin.config.page.add') }}" class="btn btn-success">
                          <i class="fas fa-plus-square"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  @foreach($page as $p)
                  <tbody>
                    <tr>
                      <td>{{ $p->id }}</td>
                      <td>{{ $p->name }}</td>
                      <td>{{ $p->content }}</td>
                      <td>{{ $p->correo }}</td>
                      <td>
                        
                        <i class=""></i>
                      </td>
                      <td>
                        <a href="{{url('/ganaderia/page/edit/'.$p->id)}}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>

                          
                        </a>
                        <a class="btn btn-danger delete-page" href="#" type="submit" data-action="delete" data-object="{{ $p->id }}" data-path="/ganaderia/page/delete/">
                        <i class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  <tfoot>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('ganaderia::unit.Name') }}</th>
                      <th> {{ trans('ganaderia::unit.Of The') }} {{ trans('ganaderia::unit.Unit') }}</th>
                      <th>{{ trans('ganaderia::unit.Description') }}</th>
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
      $(document).on("click", ".delete-page", function() {
        var id = $(this).data('object');
        var url = "{{ url('/ganaderia/page/delete/') }}/"+id;
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

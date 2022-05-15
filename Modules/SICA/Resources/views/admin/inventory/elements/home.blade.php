@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
    <div class="d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-12">
        <div class="card-header">
              <h3 class="card-title">Elementos</h3>
        </div>
              <!-- /.card-header -->
        <div class="card-body">
            <div class="btns">
            <a href="" class="btn btn-primary "><i class="fas fa-user-plus"></i> Agregar Elemento</a>
            <a href="" class="btn btn-info float-right ml-1"> Categorias</a>    
            <a href="" class="btn btn-info float-right ml-1"> Lineas</a>

        </div>
        <div class="mtop16">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Unidad</th>
                    <th>Descripción</th>
                    <th>Linea</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($elements as $e)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $e->UNSPSC_code }}</td>
                    <td>{{ $e->name }}</td>
                    <td>{{ $e->measurement_unit_id }}</td>
                    <td>{{ $e->description }}</td>
                    <td>{{ $e->kind_of_purchose_id }}</td>
                    <td>{{ $e->categorie_id }}</td>
                    <td>
                    <div class="opts">
                      <a href="{{ url('admin/re/edit/'.$e->id) }}" data-toggle='tooltip' data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>
                      <a href="{{ url('admin/re/edit/'.$e->id) }}" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                      <a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="{{ $e->id }}" data-path="admin/role" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>

                </table>
            </div>
              </div>
              <!-- /.card-body -->
      </div>

        </div>
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
@endsection    
    
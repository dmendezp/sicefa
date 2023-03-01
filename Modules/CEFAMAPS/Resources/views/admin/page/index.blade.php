@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-regular fa-file-lines"></i> {{ trans('cefamaps::page.page') }}</a></li>
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
                      <th>{{ trans('cefamaps::page.Name') }}</th>
                      <th>{{ trans('cefamaps::page.Content') }}</th>
                      <th>{{ trans('cefampas::menu.Id') }} {{ trans('cefamaps::environment.Environment') }}</th>
                      <th>
                        <a href="{{ route('cefamaps.admin.config.page.add') }}" class="btn btn-success">
                          <i class="fa-solid fa-square-plus"></i>
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
                      <td>{{ $p->environment_id }}</td>
                      <td>
                        <a href="{{url('/cefamaps/page/edit/'.$p->id)}}" class="btn btn-warning">
                          <i class="fas fa-map-signs"></i>
                        </a>
                        <a class="btn btn-danger delete-page" href="#" type="submit" data-action="delete" data-object="{{ $p->id }}" data-path="/cefamaps/page/delete/">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  <tfoot>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::page.Name') }}</th>
                      <th>{{ trans('cefamaps::page.Content') }}</th>
                      <th>{{ trans('cefampas::menu.Id') }} {{ trans('cefamaps::environment.Environment') }}</th>
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
        var url = "{{ url('/cefamaps/page/delete/') }}/"+id;
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
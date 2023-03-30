@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-regular fa-file-lines"></i> {{ trans('cefamaps::page.page') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-square-plus"></i> {{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::page.Page') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::page.Page') }}</h3>
            </div>
            <div class="card-body">
              <form method="post" action="{{ route('cefamaps.admin.config.page.add')}}" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-start">
                  <!-- inicio del nombre -->
                  <div class="col">
                    <div class="form-group">
                      <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::page.Page') }}</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                  </div>
                  <!-- fin del nombre -->
                  <!-- inicio de los id de los environments -->
                  <div class="col">
                    <div class="form-group">
                      <label for="environ">{{ trans('cefamaps::unit.Id') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::page.Page') }}</label>
                      <select class="form-control select2" name="environ" id="environ" required>
                        @foreach($environ as $e)
                          <option value="{{ $e->id }}">{{ $e->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <!-- fin de los id de los environments -->
                </div>
                <!-- inicio de agregar el contenido -->
                <div class="form-group">
                  <label for="content">{{ trans('cefampas::page.Content') }}</label>
                  <textarea id="summernote" name="content"></textarea>
                </div>
                <!-- fin de agregar el contenido -->
                <!-- inicio del boton de guardar -->
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::menu.Save') }} {{ trans('cefamaps::page.Page') }}</button>
                </div>
                <!-- fin del boton de guardar -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

  <script>
    $(function() {
      $('#summernote').summernote({
        height: 300,
      })
    });
  </script>

@endsection
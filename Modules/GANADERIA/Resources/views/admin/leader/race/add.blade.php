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
              <h3 class="m-0">{{ trans('ganaderia::menu.add') }} {{ trans('ganaderia::leader.Race') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form action="{{ route('ganaderia.admin.race.addpost') }}" method="post">
                  @csrf
                  <!-- inicio del nombre -->
                  <div class="form-group">
                    <label for="name">{{ trans('ganaderia::leader.Name') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Race') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <!-- fin del nombre -->
                  <!-- inicio del boton -->
                  <div class="d-grip gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-success btn-lg">
                      {{ trans('ganaderia::menu.Add') }}
                    </button>
                  </div>
                  <!-- fin del boton -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
@endsection
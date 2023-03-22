@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-school"></i> {{ trans('cefamaps::environment.Environment') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><img src="{{ asset('cefamaps/images/uploads/'.$viewenviron->picture) }}" width="25" height="25"> {{ $viewenviron->name }}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::environment.Environment') }} - {{ $viewenviron->name }}</h3>
            </div>
            <div class="card-body">
              <div class="row align-items-start">
                @foreach($viewenviron->pages as $v)
                  {!! $v->content !!}
                @endforeach
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
jQuery(document).ready(function($) {
  var options = {
    height: 200
  };

  var text = $('#text');
  text.summernote(options);
  text.summernote('code',text.text()); //here is the trick
});
</script>

@endsection

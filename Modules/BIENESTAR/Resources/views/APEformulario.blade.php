@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="container text-center">
                    <br>
  
</div>

            </div>
            <div class="row">
    <div class="col-4">
      <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="container text-center">
                    <br>
  
</div>

            </div>
    </div>
    <div class="col-8">
      <div class="card">
                <div class="card-header" id="im1">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="container text-center">
                    <br>
  
</div>

            </div>
    </div>
  </div>
        </div>
    </div>
</div>
<br>
    <br>
      <div class="container text-center">
  <div class="row">
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
    <p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>
  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
<p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
<p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
<p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
  </div>
</div>
@endsection
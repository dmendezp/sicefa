
@extends('evs::layouts.master')

@section('title','Home')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('cefa.evs.voto.votar') }}"><i class="fas fa-vote-yea"></i> Votar</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <div class="col-md-4">
              <div class="card card-purple card-outline shadow">
                <div class="card-header text-muted border-bottom-0">
                  Validar aprendiz
                </div>
                <div class="card-body pt-0">

                  {!! Form::open(['url' => route('cefa.evs.voto.votar.validar')]) !!}
                  <label for="name">Documento:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="far fa-keyboard"></i>
                      </span>
                    </div>
                    {!! Form::text('document',null, ['class'=>'form-control']) !!}
                  </div>
                  <label class="mtop16" for="name">Código de seguridad:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="far fa-keyboard"></i>
                      </span>
                    </div>
                    {!! Form::password('securityCode', ['class'=>'form-control']) !!}
                  </div>
                  
                  {!! Form::submit('Enviar',['class'=>'btn btn-success mtop16']) !!}
                  
                  {!! Form::close() !!}

                </div>

              </div>
            </div>

        </div>

      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

@stop

@extends('evs::layouts.master')

@section('title','Login')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.jurados.index') }}"><i class="fas fa-home"></i> Home</a>
</li>
@endsection

@section('content')
   
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
        <div class="d-flex justify-content-start">
          <div class="p-3 mb-2 bg-info text-dark">Jurado: {{ $person->first_name." ".$person->first_last_name." ".$person->second_last_name }}</div>
        </div>
        <div class="row justify-content-md-center">

          <div class="col-md-4">
              <div class="card card-purple card-outline shadow">
                <div class="card-header text-muted border-bottom-0">
                  {{ $person->juries[0]->election->name }}
                </div>
                <div class="card-body pt-0">
                  
                  {!! Form::open(['url' => route('cefa.evs.juries.search'),'id'=>'formSearchDocument']) !!}
                  <label>Autorizar Votante</label>
                  <hr>
                  <label for="name">Documento:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="far fa-keyboard"></i>
                      </span>
                    </div>
                    {!! Form::text('document_v',null, ['class'=>'form-control', 'id'=>'document_v']) !!}
                  </div>
                  {!! Form::hidden('election',$person->juries[0]->election->id, ['id'=>'election']) !!}
                  {!! Form::hidden('jury',session('jury_id'), ['id'=>'jury']) !!}
                  {!! Form::button('Buscar',['class'=>'btn btn-info mtop16', 'id'=>'btnSearchV']) !!}
                  
                  {!! Form::close() !!}
                  <div id="votante" class="mtop16">
                  </div>

                </div>

              </div>
            </div>

        </div>

      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

@stop
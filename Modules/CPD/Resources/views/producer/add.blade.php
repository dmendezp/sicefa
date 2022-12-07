@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('cpd.admin.producer.index') }}">Productores</a>
    </li>
    <li class="breadcrumb-item">
        Registro
    </li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-8 mx-auto">
                    <div class="card card-primary card-outline">
                        <div class="card-header py-2">
                            <h4><b>{{ $view['titleView'] }}</b></h4>
                        </div>
                        {!! Form::open(['route' => 'cpd.admin.study.add', 'method' => 'POST', 'role' => 'form']) !!}
                            <div class="card-body pb-0">
                                Formulario para registrar productor
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('cpd.admin.study.index') }}" class="btn btn-light float-left" data-toggle='tooltip' data-placement="top" title="Cancelar registro">
                                    <b>Cancelar</b>
                                </a>
                                <button type="submit" class="btn btn-primary float-right" data-toggle='tooltip' data-placement="top" title="Registrar monitoreo">
                                    <b>Guardar</b>
                                </button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div> <!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')

@endsection

@extends('cafeto::layouts.admin')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">{{ __('Sales')}}</a></li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- <div class="card card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Sales')}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            {!! Form::open(['url' => 'gymstorm/admin/gym/users/search']) !!}
                            {{csrf_field()}}



                            {!! Form::search('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el documento.', 'required']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                            {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!} --}}

            <div id="example">
                
            </div>


            
        </div>

    </div>
    <!-- /.card-body -->
</div>

@endsection
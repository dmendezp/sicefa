@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="card card-primary card-outline col-10 mx-auto">
        <div class="card-header">
            <h4>Formulario Elementos</h4>
        </div>
        {!! Form::open(['route'=>'sica.admin.inventory.elements.store', 'method'=>'POST', 'id'=>'form-config']) !!}
            <div class="card-body">
                @include('sica::admin.inventory.elements.form')
            </div>
            <div class="card-footer bg-white ">
                {!! Form::submit('Registrar', ['class'=>'btn btn-primary btn-md py-0 float-right']) !!}
                <a href="{{ route('sica.admin.inventory.elements') }}" class="btn btn-sm btn-light btn-md py-0 float-right">
                    <b>Cancelar</b>
                </a>
           </div>
        {!! Form::close() !!}   
    </div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection   

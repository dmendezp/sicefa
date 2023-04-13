@extends('ptventa::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
    <li class="breadcrumb-item active">Actualizar Elementos</li>
@endsection

@section('content')

<div class="card card-warning card-outline col-8 mx-auto">
    <div class="card-header">
        <h4>Formulario Producto</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('ptventa.admin.element.update', $element) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('ptventa::utilities.validationErrors')
       <div class="row">
          <div class="col-sm-6">
                <div class="card-body">
                    <div class="row">
                        <label><b>Nombre: </b><small>{{ $element->name }}</small></label>
                    </div>
                    <div class="row">
                        <label><b>Precio: </b><small>$3.000</small></label>
                    </div>
                </div>
          </div>
          <div class="col-sm-6 mt-2">
            <div class="card border-warning mb-3" style="max-width: 25rem;">
                <div class="card-header">Imagen</div>
                <div class="card-body">
                    <div class="grid grid-col-1 mt-5 mx-7">
                     <img src="{{ asset($element->image) }}" id="imagenSeleccionada" class="img-fluid rounded-start" style="max-height: 200px">
                    </div>
                    <div class="grid grid-col-1 mt-5 mx-7">
                        <label>Subir imagen</label>
                        <div class="flex items-center justify-center w-full">
                            <input type="file" name="image" id="image" class="hidden">
                       </div>
                    </div>
                </div>
            </div>
          </div>
       </div>
    </div>
        <div class="card-footer bg-white">
            <a href="{{ route('ptventa.admin.element.index') }}" class="btn btn-sm btn-light float-left">
                <b>Cancelar</b>
            </a>
            <button type="submit" class="btn btn-sm btn-warning float-right">
                <b>Actualizar</b>
            </button>
        </div>
</div>
</form> 
@endsection
@section('scripts')
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
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
       <div class="row">
          <div class="col-sm-6">
                <div class="card-body">
                        @csrf
                    <div class="row">
                        <label><b>Nombre: </b><small>{{ $element->name }}</small></label>
                    </div>
                    <div class="row">
                        <label><b>Unidad de medida: </b><small>{{ $element->measurement_unit->name }}</small></label>
                    </div>
                    <div class="row">
                        <label><b>Descripción: </b><small>{{ $element->description }}</small></label>
                    </div>
                    <div class="row">
                        <label><b>Tipo de compra: </b><small>{{ $element->kind_of_purchase->name }}</small></label>
                    </div>
                    <div class="row">
                        <label><b>Categoria: </b><small>{{ $element->category->name}}</small></label>
                    </div>
                </div>
          </div>
          <div class="col-sm-6 mt-2">
            <div class="card border-warning mb-3" style="max-width: 25rem;">
                <div class="card-header">Imagen</div>
                <div class="card-body">
                    <img src="{{ asset('ptventa/images/Card1.jpg') }}" class="img-fluid rounded-start" style="max-height: 200px">
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
        {!! Form::close() !!}
</div>
@endsection
@section('scripts')
@endsection
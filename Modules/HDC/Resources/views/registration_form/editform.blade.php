@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::ConsumptionRegistry.edit_form') }}</li>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-body">
                            <h2 class="card-title"><strong>{{ trans('hdc::ConsumptionRegistry.edit_form_title') }}</strong></h2>

                            <form action="{{ route('cefa.hdc.update', ['id' => $data['id']]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Aquí debes agregar los campos del formulario para la edición -->
                                <!-- Por ejemplo, campos para actualizar la unidad productiva, actividades, etc. -->

                                <button type="submit" class="btn btn-primary">{{ trans('hdc::ConsumptionRegistry.update_button') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

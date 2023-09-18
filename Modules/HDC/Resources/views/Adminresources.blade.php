@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::adminresources.Indicator_manageresources')}}</li>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-green card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('hdc::adminresources.ct1') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 pr-3 pb-3">
                            <form action="{{ route('hdc.adminresources.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>{{ trans('hdc::adminresources.label1') }}</label>
                                    <select name="productive_unit_id" class="form-control" required>
                                        <option value="">{{ trans('hdc::adminresources.select1') }}</option>
                                        @foreach ($activity_id as $a) {{-- Consulta las unidades productivas de SICEFA --}}
                                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('hdc::adminresources.label2') }}</label>
                                    <select name="Resource_id" class="form-control" required>
                                        <option value="">{{ trans('hdc::adminresources.select1') }}</option>
                                        @foreach($environmental_aspect_id as $ea)
                                            <option value="{{ $ea->name }}">{{ $ea->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" background-color="green">{{ trans('hdc::adminresources.btn1') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>{{ trans('hdc::adminresources.th1') }}</th>
                                            <th>{{ trans('hdc::adminresources.th2')}}</th>
                                            <th class="text-center">{{ trans('hdc::adminresources.th3') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activity_id as $a)
                                            @foreach ($environmental_aspect_id as $ea )
                                                <tr>
                                                    <td >
                                                    {{ $a->name }}
                                                    </td>
                                                    <td>{{ $ea->name }}</td>
                                                    <td class="text-center">
                                                        <a href="hdc.adminresources" data-toogle='tooltip' data-placement="top" title="Eliminar"
                                                            onclick="return confirm('¿Estas Seguro Que Deseas Eliminar La Asociación De La Unidad Productiva {{ $a->name }} Y El Aspecto Ambiental {{ $ea->name }}?')">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
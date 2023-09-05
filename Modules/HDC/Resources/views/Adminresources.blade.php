@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::hdcgeneral.li2')}}</li>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-green card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('hdc::hdcgeneral.ct1') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 pr-3 pb-3">
                            <form action="{{ route('sica.admin.units.pu_warehouses.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>{{ trans('hdc::hdcgeneral.label1') }}</label>
                                    <select name="productive_unit_id" class="form-control" required>
                                        <option value="">{{ trans('hdc::hdcgeneral.option1') }}</option>
                                        @foreach ($productive_unit as $pro) {{-- Consulta las unidades productivas de SICEFA --}}
                                            <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('hdc::hdcgeneral.label2') }}</label>
                                    <select name="Resource_id" class="form-control" required>
                                        <option value="">{{ trans('hdc::hdcgeneral.option2') }}</option>
                                        @foreach($resource as $re)
                                            <option value="{{ $re->id }}">{{ $re->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ trans('hdc::hdcgeneral.btn1') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>{{ trans('hdc::hdcgeneral.th1') }}</th>
                                            <th>{{ trans('hdc::hdcgeneral.th2') }}</th>
                                            <th class="text-center">{{ trans('hdc::hdcgeneral.th3') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productive_unit as $pro)
                                        @foreach ($resource as $re)
                                            <tr>
                                                <td >
                                                {{ $pro->name }}
                                                </td>
                                                <td>{{ $re->name }}</td>
                                                <td class="text-center">
                                                    <a href="" data-toogle='tooltip' data-placement="top" title="Eliminar"
                                                        onclick="return confirm('¿Estas Seguro Que Deseas Eliminar La Asociación De La Unidad Productiva {{ $pro->name }} Y El Recurso {{ $re->name }}?')">
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
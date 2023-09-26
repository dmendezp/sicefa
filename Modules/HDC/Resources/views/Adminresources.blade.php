@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::adminresources.Indicator_manageresources')}}</li>
@endpush

@section('content')

        <div class="">
            <div class="card card-green card-outline shadow col-12">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('hdc::adminresources.ct1') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('hdc.adminresources.store') }}" method="post">
                        @csrf
                        <div class="row">
                            
                                <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('hdc::adminresources.label1') }}</label>
                                    <select name="activity_id" class="form-control" required>
                                        <option value="">{{ trans('hdc::adminresources.select1') }}</option>
                                        @foreach ($productive_unit as $pro) {{-- Consulta las actividades de las unidades productivas de SICEFA --}}
                                            <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('hdc::adminresources.label2') }}</label>
                                    <select name="Environmental Aspect" class="form-control" required>
                                        <option value="">{{ trans('hdc::adminresources.select1') }}</option>
                                        @foreach($activities as $a)
                                            <option value="{{ $a->name }}">{{ $a->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <style>
                                    .checklist {
                                        display: inline-block;
                                        margin-left: 20px;
                                    }
        
                                    label{
                                        display: block;
                                    }
                                </style>
                                </div>
                                <div class="col-6">
                                    <h2>{{ trans('hdc::adminresources.title_checklist') }}</h2>
                                    <div class="checklist">
                                            <label for="Aspecto1">
                                                <input type="checkbox" name="actividades[]" id="Aspecto1"  value="Aspecto 1">
                                                {{ trans('hdc::adminresources.water_consumption') }}
                                            </label>
                                            <label for="Aspecto2">
                                                <input type="checkbox" name="actividades[]" id="Aspecto2" value="Aspecto 2">
                                                {{ trans('hdc::adminresources.energy_consumption') }}
                                            </label>
                                            <label for="Aspecto3">
                                                <input type="checkbox" name="actividades[]" id="Aspecto3" value="Aspecto 3">
                                                {{ trans('hdc::adminresources.gas_consumption') }}
                                            </label>
                                            <label for="Aspecto4">
                                                <input type="checkbox" name="actividades[]" id="Aspecto4" value="Aspecto 4">
                                                {{ trans('hdc::adminresources.fuel_consumption') }}
                                            </label>
                                            <label for="Aspecto5">
                                                <input type="checkbox" name="actividades[]" id="Aspecto5" value="Aspecto 5">
                                                {{ trans('hdc::adminresources.Solid_waste') }}
                                            </label>
                                            <label for="Aspecto6">
                                                <input type="checkbox" name="actividades[]" id="Aspecto6" value="Aspecto 6">
                                                {{ trans('hdc::adminresources.organic_waste') }}
                                            </label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success" background-color="green">{{ trans('hdc::adminresources.btn1') }}</button>
                                </div>
                        </div><br>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-stripped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ trans('hdc::adminresources.th1') }}</th>
                                        <th>{{ trans('hdc::adminresources.th2') }}</th>
                                        <th>{{ trans('hdc::adminresources.th3')}}</th>
                                        <th class="text-center">{{ trans('hdc::adminresources.th4') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productive_unit as $pro)
                                    @foreach ($activities as $a)
                                        @foreach ($environmentalAspect as $ea )
                                            <tr>
                                                <td >
                                                {{ $pro->name}}
                                                </td>
                                                <td>{{ $a->name }}</td>
                                                <td>{{ $ea->name }}</td>
                                                <td class="text-center">
                                                    <a href="hdc.adminresources.update" data-toogle='tooltip' data-placement="top" title="Editar"
                                                        onclick="return confirm('¿Estas Seguro Que Deseas Modificar La Asociación De La Actividad {{ $pro->name }} Y El Aspecto Ambiental {{ $a->name }} Y El Aspecto Ambiental {{ $ea->name }}?')">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="hdc.adminresources.delete" data-toogle='tooltip' data-placement="top" title="Eliminar"
                                                        onclick="return confirm('¿Estas Seguro Que Deseas Eliminar La Asociación De La Actividad {{ $pro->name }} Y El Aspecto Ambiental {{ $a->name }} Y El Aspecto Ambiental {{ $ea->name }}?')">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
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

@endsection
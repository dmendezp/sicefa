@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::ConsumptionRegistry.indicator_form') }}</li>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-body">
                            <label>{{ trans('hdc::ConsumptionRegistry.Title_Card_Productive_Unit') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i>
                                    </span>
                                    <select class="form-select" name="productive_unit_id" id="productive_unit_id" disabled>
                                        <option value="" selected disabled>
                                            --{{ trans('hdc::ConsumptionRegistry.Select_Productive_Unit') }}--</option>
                                        <option value="{{ $labor->activity->productive_unit->id }}" selected>
                                            {{ $labor->activity->productive_unit->name }}</option>
                                    </select>

                                </div>
                            </div>
                            <label>{{ trans('hdc::ConsumptionRegistry.Title_Card_Activities') }} </label>
                            <div class="input-group">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-user-alt fs-10"></i>
                                    </span>
                                    <select class="form-select" name="activity_id" id="activity_id" disabled>
                                        <option value="{{ $labor->activity->id }}" selected disabled>
                                            {{ $labor->activity->name }}</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-8">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-body">
                            <h5>{{ trans('hdc::ConsumptionRegistry.Title_Card_results') }}:</h5>
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('cefa.hdc.update', ['labor' => $labor]) }}">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($labor->environmental_aspect_labors as $envasp)
                                                    <tr>
                                                        <td>{{ $envasp->environmental_aspect->name }}</td>
                                                        <td>
                                                            <input type="text" name="amounts[]" value="{{ $envasp->amount }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-around">
                                            <!-- Botón de guardar -->
                                            <button type="submit"
                                                class="btn btn-success">{{ trans('hdc::ConsumptionRegistry.Btn_Update') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

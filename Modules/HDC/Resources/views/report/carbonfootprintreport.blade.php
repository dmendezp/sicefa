@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::report.Report_Indicator') }}</li>
@endpush

@section('content')
    <div class="container">
        <h2 class="text-center">{{ trans('hdc::report.Title_View_Report') }}</h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success card-outline shadow mt-2">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">{{ trans('hdc::report.Title_Card_Productive_Units') }}</h3>
                        <table class="table table-bordered custom-table-style">
                            <thead>
                                <tr>
                                    <th>{{ trans('hdc::report.Column_Productive_Unit') }}</th>
                                    <th>{{ trans('hdc::report.Carbon_Footprint_Column') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aspectosAmbientales as $unit)
                                    <tr>
                                        <td>{{ $unit['productive_unit_name'] }}</td>
                                        <td>{{ $unit['carbon_footprint'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-success card-outline shadow mt-2">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">{{ trans('hdc::report.Title_Card_Sectors') }}</h3>
                        <table class="table table-bordered custom-table-style">
                            <thead>
                                <tr>
                                    <th>{{ trans('hdc::report.Sector_Column') }}</th>
                                    <th>{{ trans('hdc::report.Carbon_Footprint_Column') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalCarbonBySector = [];
                                @endphp

                                @foreach($aspectosAmbientales as $aspecto)
                                    @php
                                        if (!isset($totalCarbonBySector[$aspecto['sector_name']])) {
                                            $totalCarbonBySector[$aspecto['sector_name']] = 0;
                                        }
                                        $totalCarbonBySector[$aspecto['sector_name']] += $aspecto['carbon_footprint'];
                                    @endphp
                                @endforeach

                                {{-- Muestra el total de la huella de carbono por sector --}}
                                @foreach($totalCarbonBySector as $sectorName => $totalCarbon)
                                    <tr>
                                        <td>{{ $sectorName }}</td>
                                        <td>{{ $totalCarbon }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <form action="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.generate.pdf') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger mx-auto">
                    <i class="fas fa-file-pdf mr-2"></i>{{ trans('hdc::report.Button_PDF') }}
                </button>
            </form>
        </div>
    </div>
    <br>
@endsection

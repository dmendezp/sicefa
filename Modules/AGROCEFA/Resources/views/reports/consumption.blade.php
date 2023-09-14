@extends('agrocefa::layouts.master')

@section('content')
    <div class="container">
        <h3>Reporte Consumo</h3>
        <form id="filterForm" method="POST" action="{{ route('agrocefa.reports.filterByDate') }}">
            @csrf
            <div class="form-group">
                <label for="startDate">{{ trans('agrocefa::reports.Start_Date') }}</label>
                <input type="date" class="form-control" name="startDate" id="startDate">
            </div>
        
            <div class="form-group">
                <label for="endDate">{{ trans('agrocefa::reports.End_Date') }}</label>
                <input type="date" class="form-control" name="endDate" id="endDate">
            </div>
        
            <button type="submit" style="margin-top: 10px" class="btn btn-primary">{{ trans('agrocefa::reports.Btn_Filter') }}</button>
        </form>
        
        <div class="container my-5">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('agrocefa::reports.1T_Date_Of_Consumable') }}</th>
                                    <th>{{ trans('agrocefa::reports.1T_Labor') }}</th>
                                    <th>{{ trans('agrocefa::reports.1T_Element') }}</th>
                                    <th>{{ trans('agrocefa::reports.1T_Amount') }}</th>
                                    <th>{{ trans('agrocefa::reports.1T_Price') }}</th>
                                    <th>{{ trans('agrocefa::reports.1T_Subtotal') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedData as $laborId => $data)
                                    <tr>
                                        <td colspan="6">
                                            <strong>{{ trans('agrocefa::reports.Labor') }} {{ $data['laborDescription'] }}</strong><br>
                                            <em>{{ trans('agrocefa::reports.Date_Labor') }} {{ $data['laborDate'] }}</em>
                                        </td>
                                        <td><strong>{{ $data['laborSubtotal'] }}</strong></td>
                                    </tr>
                                    @foreach ($data['elements'] as $element)
                                        <tr>
                                            <td></td>
                                            <td>{{ $data['laborDate'] }}</td>
                                            <td>{{ $data['laborDescription'] }}</td>
                                            <td>{{ $element['elementName'] }}</td>
                                            <td>{{ $element['consumableAmount'] }}</td>
                                            <td>{{ $element['consumablePrice'] }}</td>
                                            <td>{{ $element['elementSubtotal'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr>
                                    <td colspan="6"><strong>{{ trans('agrocefa::reports.1T_Total') }}</strong></td>
                                    <td><strong>{{ $totalLaborSubtotal }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

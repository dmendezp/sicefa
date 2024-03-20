@if (!empty($groupedData) && count($groupedData) > 0)
    <div class="table-responsive">
        <table id="table_inventory" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('agrocefa::reports.1T_Element') }}</th>
                    <th>{{ trans('agrocefa::reports.1T_Amount') }}</th>
                    <th>{{ trans('agrocefa::reports.1T_Price') }}</th>
                    <th>Fecha Vencimiento</th>
                    <th>{{ trans('agrocefa::reports.1T_Subtotal') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedData as $laborId => $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td colspan="4">
                            <strong>{{ trans('agrocefa::reports.Labor') }} {{ $data['laborDescription'] }}</strong><br>
                            <em>{{ trans('agrocefa::reports.Date_Labor') }} {{ $data['laborDate'] }}</em>
                        </td>
                        <td><strong>{{ $data['laborSubtotal'] }}</strong></td>
                    </tr>
                    @foreach ($data['elements'] as $element)
                        <tr>
                            <td></td>
                            <td>{{ $element['elementName'] }}</td>
                            <td>{{ $element['consumableAmount'] }}</td>
                            <td>{{ $element['consumablePrice'] }}</td>
                            <td>{{ priceFormat($element['elementSubtotal']) }}</td>
                            <td>{{ $element['expiration_date'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td colspan="5"><strong>{{ trans('agrocefa::reports.1T_Total') }}</strong></td>
                    <td><strong>{{ $totalLaborSubtotal }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
@else
<br>
@if (isset($no_found))
<p>{{ $no_found }}</p>
@endif  
@endif
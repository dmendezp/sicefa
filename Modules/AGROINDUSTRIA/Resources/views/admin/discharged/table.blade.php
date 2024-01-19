<table id="discharge" class="hover" style="width: 100%;">
    <thead>
        <tr>
            <th>{{trans('agroindustria::menu.Date Time')}}</th>
            <th>{{trans('agroindustria::menu.Responsible')}}</th>
            <th>{{trans('agroindustria::menu.Element')}}</th>
            <th>{{trans('agroindustria::menu.Amount')}}</th>
            <th>{{trans('agroindustria::menu.Price')}}</th>
            <th>{{trans('agroindustria::menu.Total Movement')}}</th>
            <th>{{trans('agroindustria::menu.Observations')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movements as $movement)
            <tr>
                <td>{{$movement->registration_date}}</td>
                <td>
                    {{$movement->movement_responsibilities->first()->person->first_name . ' ' .
                    $movement->movement_responsibilities->first()->person->first_last_name . ' ' .
                    $movement->movement_responsibilities->first()->person->second_last_name}}
                </td>
                <td>
                    @foreach ($movement->movement_details as $detail)
                        {{$detail->inventory->element->name}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($movement->movement_details as $detail)
                        {{$detail->amount}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($movement->movement_details as $detail)
                        {{$detail->price}}<br>
                    @endforeach
                </td>
                <td>{{$movement->price}}</td>
                <td>{{$movement->observation}}</td>
            </tr>
        @endforeach
    </tbody>
    
</table>
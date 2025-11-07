@if (!empty($inventory) && count($inventory) > 0)
<div class="table-responsive">
    <table id="table_inventory" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('agrocefa::inventory.Element') }}</th>
                <th>{{ trans('agrocefa::inventory.Category') }}</th>
                <th >{{ trans('agrocefa::inventory.Price') }}</th>
                <th >{{ trans('agrocefa::inventory.Amount') }}</th>
                <th>{{ trans('agrocefa::inventory.Destination') }}</th>
                <th>Stock M</th>
            </tr>
        </thead>
        <tbody>
            @php
                $shownWarehouses = [];
            @endphp

            @foreach ($inventory as $item)
                @php
                    $measurement_unit = $item->element->measurement_unit->conversion_factor;
                    $currentWarehouse = $item->productive_unit_warehouse->warehouse->name;
                @endphp
                <tr>
                    <td >{{ $loop->iteration }}</td>
                    <td >{{ $item->element->name }}</td>
                    <td >{{ $item->element->category->name }}</td>
                    <td class="text-center">{{ priceFormat($item->price) }}</td>
                    <td class="text-center">{{ $item->amount / $measurement_unit}}</td>
                    <td >{{ $item->destination }}</td>
                    <td class="text-center">{{ $item->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<br>
@if (isset($no_found))
<p>{{ $no_found }}</p>
@endif  
@endif
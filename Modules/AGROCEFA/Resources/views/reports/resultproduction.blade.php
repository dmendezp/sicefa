@if (!empty($filterproductions) && count($filterproductions) > 0)
    <div class="card">
        <div class="card-header">
            {{ __('agrocefa::produccion.Production') }}
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <!-- Encabezado de la tabla -->
                <thead id='cabecera'>
                    <tr>
                        <th>{{ __('agrocefa::produccion.Labor') }}</th>
                        <th>{{ __('agrocefa::produccion.Element') }}</th>
                        <th>{{ __('agrocefa::produccion.Quantity') }}</th>
                        <th>{{ __('agrocefa::produccion.Expiration_date') }}</th>
                        <th>{{ __('agrocefa::produccion.Total_production_price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filterproductions as $production)
                    <tr>
                        <td>{{ $production->labor->activity->name }}</td>
                        <td>{{ $production->element->name }}</td>
                        <td>{{ $production->amount }}</td>
                        <td>{{ $production->expiration_date }}</td>
                        <td>{{ session('totalProductions') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! Form::open(['method' => 'post', 'url' => route('agrocefa.reports.productionpdf')]) !!}
        {!! Form::hidden('id', '{{session("filterproductions")}}') !!}
        <button type="submit" style="margin-left: 550px" class="btn btn-danger" target="_blank">{{ trans('agrocefa::produccion.Export') }} <i class="fa-solid fa-file-pdf"></i></button>
        {!! Form::close() !!}
        <br>        
    </div>

@else
    <br>
    @if (isset($no_found))
        <p>{{ $no_found }}</p>
    @endif  
@endif

<style>
    #pdf {
        width: 14%;
        margin: 0 auto;
        display: inline-block;
        text-align: center;
    }
</style>

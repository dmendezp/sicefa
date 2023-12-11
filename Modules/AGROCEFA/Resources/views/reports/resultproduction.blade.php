@if (!empty($filterproductions) && count($filterproductions) > 0)
    <div class="card">
        <div class="card-header">
            {{ __('agrocefa::produccion.production') }}
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <!-- Encabezado de la tabla -->
                <thead>
                    <tr>
                        <th>{{ __('agrocefa::produccion.labor') }}</th>
                        <th>{{ __('agrocefa::produccion.element') }}</th>
                        <th>{{ __('agrocefa::produccion.quantity') }}</th>
                        <th>{{ __('agrocefa::produccion.expiration_date') }}</th>
                        <th>{{ __('agrocefa::produccion.total_production_price') }}</th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla -->
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
        
        <a id="pdf" href="{{ route('agrocefa.reports.productionpdf') }}" class="btn btn-danger" target="_blank">{{ trans('agrocefa::balance.export') }} <i class="fa-solid fa-file-pdf"></i></a>        
    </div>

@else
    <br>
    <p>{{ __('agrocefa::produccion.no_labor_selected') }}</p>
@endif

<style>
    #pdf {
        width: 14%;
        margin: 0 auto;
        display: inline-block;
        text-align: center;
    }
</style>

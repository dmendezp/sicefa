
<form method="POST" id="form-result" action="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.guardar.valores') }}">
    @csrf
    <input name="activity_id" class="form-control" type="hidden" value="{{ $activity_id }}">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aspects[0]['environmental_aspects'] as $aspecto)
                    <tr>
                        <td>{{ $aspecto['name'] }}</td>
                        <td>
                            <input name="aspecto[{{ $aspecto['id'] }}][id]" type="hidden" value="{{ $aspecto['id'] }}">
                            <input name="aspecto[{{ $aspecto['id'] }}][amount]" class="form-control" type="number"
                                placeholder="{{ $aspecto['measurement_unit']['name'] }}" ><span
                                class="badge text-danger errors-amount"></span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-around">
            <!-- Botón de guardar -->
            <button type="submit" id="btn-enviar" class="btn btn-success">{{ trans('hdc::ConsumptionRegistry.Btn_Save') }}</button>
        </div>
    </div>
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        // ... 
        alert('Hola');


    });

</script>
@endpush

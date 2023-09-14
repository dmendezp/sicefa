<label>{{ trans('hdc::ConsumptionRegistry.Title_Card_Activities') }} </label>
<div class="input-group">
    <div class="input-group-prepend w-100">
        <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-user-alt fs-10"></i> <!-- Ajusta el tamaño aquí -->
        </span>
        <select class="form-select" name="activity_id" id="activity_id">
            <option value="">-- {{ trans('hdc::ConsumptionRegistry.Select_Activity') }} --</option>
            @foreach($activities as $activi)
                <option value="{{ $activi->id }}">{{ $activi->name }}</option>
            @endforeach
        </select>
    </div>
</div>


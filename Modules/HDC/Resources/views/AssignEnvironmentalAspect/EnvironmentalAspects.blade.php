<div class="col-md-12">
    <h2>{{ trans('hdc::assign_environmental_aspects.title_checklist') }}</h2>
    <div name="Environmetal_Aspect" class="checkbox" required="true">
        @foreach ($environmentalAspect as $key => $ea)
        <div class="form-check">
            <input type="checkbox" name="Environmental_Aspect[]" id="Aspecto{{ $ea->id }}" value="{{ $ea->id }}" class="form-check-input">
            <label class="form-check-label" for="Aspecto{{ $ea->id }}">{{ $ea->name }}</label>
        </div>
        @endforeach
    </div>
</div>


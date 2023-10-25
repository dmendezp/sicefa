@extends('hdc::layouts.master')
@push('breadcrumbs')
<li class="breadcrumb-item active"><a href=""></a>{{ trans('hdc::assign_environmental_aspects.Indicator_assign_environmental_aspects')}}</li>
@endpush

@section('content')
<div class="">
    <div class="card card-green card-outline shadow col-12">
        <div class="card-header">
            <h3 class="card-title">{{ trans('hdc::assign_environmental_aspects.ct1') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('cefa.hdc.updateEnvironmentalAspects') }}" method="post"> {{-- Cambio de ruta a 'updateEnvironmentalAspects' --}}
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>{{ trans('hdc::assign_environmental_aspects.label1') }}</label>
                            <select name="productive_unit_id" class="form-control" required>
                                <option value="">{{ trans('hdc::assign_environmental_aspects.select1') }}</option>
                                @foreach ($productive_unit as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('hdc::assign_environmental_aspects.label2') }}</label>
                            <select name="activity_id" class="form-control" required>
                                <option value="">{{ trans('hdc::assign_environmental_aspects.select1') }}</option>
                                @foreach($activities as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <style>
                            .checklist {
                                display: inline-block;
                                margin-left: 20px;
                            }

                            label {
                                display: block;
                            }
                        </style>
                    </div>
                    <div class="col-6">
                        <h2>{{ trans('hdc::assign_environmental_aspects.title_checklist') }}</h2>
                        <div name="Environmetal_Aspect" class="checkbox" required="true">
                            @foreach ($environmentalAspect as $key => $ea)
                            <label for="Aspecto{{ $ea->id }}">
                                <input type="checkbox" name="Environmental_Aspect[]" id="Aspecto{{ $ea->id }}"
                                    value="{{ $ea->id }}">
                                {{ $ea->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success" background-color="green">{{
                            trans('hdc::assign_environmental_aspects.btn1') }}</button>
                    </div>
                </div><br>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            var activitySelect = $('select[name="activity_id"]');
                activitySelect.on('change', function() {
                    var selectedActivityId = $(this).val();
                    
                if (selectedActivityId) {
                    // Utiliza el nombre de la ruta para obtener la URL
                    var url = "{{ route('cefa.hdc.getEnvironmentalAspects', ':id') }}";
                    url = url.replace(':id', selectedActivityId);

                    $.get(url, function(data) {
                        $('input[name="Environmental_Aspect"]').prop('checked', false);
                        data.forEach(function(aspectId) {
                            $('#Aspecto' + aspectId).prop('checked', true);
                        });
                    });
                } else {
                    $('input[name="Environmental_Aspect"]').prop('checked', false);
                }
            });
        });
    </script>
@endpush
@endsection
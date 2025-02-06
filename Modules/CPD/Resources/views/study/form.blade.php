@if (isset($study))
    {!! Form::hidden('study_id', $study->id) !!}
@endif
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header py-1">
                <h3 class="card-title">{{ trans('cpd::monitoring.Form_Title_Monitoring_Dates') }}</h3>
            </div>
            <div class="card-body pt-2 pb-0">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto pt-1">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('producer_id', trans('cpd::monitoring.F_Text_Producer'), ['class' => 'form-label']) !!}
                                </div>
                                <div class="col ms-0 ps-0">
                                    {!! Form::select('producer_id', $producers, isset($study) ? $study->producer_id : null, [
                                        'placeholder' => trans('cpd::monitoring.F_Select'),
                                        'class' => 'form-control',
                                        'id' => 'producer_id',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto pt-1">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('village_id', trans('cpd::monitoring.F_Text_Village'), ['class' => 'form-label']) !!}
                                </div>
                                <div class="col ms-0 ps-0">
                                    {!! Form::select('village_id', $villages, isset($study) ? $study->village_id : null, [
                                        'placeholder' => trans('cpd::monitoring.F_Select'),
                                        'class' => 'form-control',
                                        'id' => 'village_id',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto pt-1">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('monitoring', trans('cpd::monitoring.F_Text_Monitoring'), ['class' => 'form-label']) !!}
                                </div>
                                <div class="col ms-0 ps-0">
                                    {!! Form::number('monitoring', isset($study) ? $study->monitoring : null, [
                                        'placeholder' => trans('cpd::monitoring.F_Placeholder_Year'),
                                        'class' => 'form-control',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => trans('cpd::monitoring.T_Year_of_monitoring'),
                                        'oninput' => 'this.value=(parseInt(this.value)||0)',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto pt-1">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('typology', trans('cpd::monitoring.F_Text_Typology'), ['class' => 'form-label']) !!}
                                </div>
                                <div class="col ms-0 ps-0">
                                    {!! Form::select('typology', getEnumValues('studies', 'typology'), isset($study) ? $study->typology : null, [
                                        'class' => 'form-control',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => trans('cpd::monitoring.T_Type_Farming'),
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto pt-1">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('altitud', trans('cpd::monitoring.F_Text_Altitude'), ['class' => 'form-label']) !!}
                                </div>
                                <div class="col ms-0 ps-0">
                                    {!! Form::number('altitud', isset($study) ? $study->altitud : null, [
                                        'placeholder' => 'm.s.n.m.',
                                        'class' => 'form-control',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => trans('cpd::monitoring.T_Meters_Sea_Level'),
                                        'oninput' => 'this.value=(parseInt(this.value)||0)',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($datas as $data)
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header py-1">
                    <h3 class="card-title">{{ $data->name }}</h3>
                </div>
                <div class="card-body pt-2 pb-0">
                    <div class="row">
                        @if ($data->metadatas->count())
                            @foreach ($data->metadatas as $metadata)
                                @php
                                    $ab = $metadata->abbreviation;
                                @endphp
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 text-right">
                                                {!! Form::label($metadata->abbreviation, $metadata->abbreviation.':', ['class' => 'form-label form-label-sm']) !!}
                                            </div>
                                            <div class="col ms-0 ps-0">
                                                {!! Form::number($metadata->abbreviation, isset($study) ? $study->$ab : null, [
                                                    'placeholder' => '####.###',
                                                    'class' => 'form-control form-control-sm',
                                                    'oninput' => 'limitDecimalPlaces(event, 3)',
                                                    'onkeypress' => 'return isNumberKey(event)',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'title' => $metadata->description.' ('.$metadata->unit_measure.')',
                                                    'step' => 'any',
                                                    'max' => '9999'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>





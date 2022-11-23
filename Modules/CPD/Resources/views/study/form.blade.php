<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header py-1">
                <h3 class="card-title">Datos generales del monitoreo</h3>
            </div>
            <div class="card-body pt-2 pb-0">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto">
                                    <b class="text-danger">*</b>
                                    {!! Form::label('producer_id', 'Productor: ', ['class' => 'form-label form-label-sm']) !!}
                                </div>
                                <div class="col ms-0 ps-0">
                                    {!! Form::select('producer_id', $producers, null, [
                                        'placeholder' => '-- Seleccione --',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'producer_id'
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
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 text-right">
                                                {!! Form::label($metadata->abbreviation, $metadata->abbreviation.':', ['class' => 'form-label form-label-sm']) !!}
                                            </div>
                                            <div class="col ms-0 ps-0">
                                                {!! Form::number($metadata->abbreviation, null, [
                                                    'placeholder' => '####.###',
                                                    'class' => 'form-control form-control-sm',
                                                    'oninput' => 'limitDecimalPlaces(event, 3)',
                                                    'onkeypress' => 'return isNumberKey(event)',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'title' => $metadata->description
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





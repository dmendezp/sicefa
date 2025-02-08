<div class="modal fade" id="documents{{$prom->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Subir documentos faltantes</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.document_store', ['id' => $prom->id]), 'method' => 'POST', 'files' => true]) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('documents', 'Cédulas') !!}
                    {!! Form::file('documents[]', ['class' => 'form-control', 'accept' => 'application/pdf']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bulk_upload','Cargue Masivo') !!}
                    {!! Form::file('documents[]', ['class' => 'form-control', 'accept' => '.xls, .xlsx']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('card','Carta') !!}
                    {!! Form::file('documents[]', ['class' => 'form-control', 'accept' => 'application/pdf']) !!}
                </div>

                <h5><b>Fechas Programadas</b></h5>
                <div id="edit_dates_container{{$prom->id}}">
                    @foreach($prom->program_request_dates as $date)
                        <input type="hidden" name="date_id[]" value="{{ $date->id }}">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="form-group">
                                <label for="edit_date">Fecha</label>
                                <input type="date" name="dates[]" class="form-control" value="{{ $date->date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_start_time">Hora de inicio</label>
                                <input type="time" name="start_time[]" class="form-control" value="{{ $date->start_time }}" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_end_time">Hora fin</label>
                                <input type="time" name="end_time[]" class="form-control" value="{{ $date->end_time }}" required>
                            </div>
                        </div>
                    @endforeach
                </div>

                <br>
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>

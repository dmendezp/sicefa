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
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>  
</div>

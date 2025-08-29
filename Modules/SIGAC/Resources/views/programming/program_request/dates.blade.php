<div class="modal fade" id="dates{{$prom->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">{{ trans('Programación')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($prom->program_request_dates as $dates)
                    <h4><b>Programación : {{ $loop->iteration }}</b></h4>
                    <ul>
                        <li>
                            <h5><b>Fecha :</b></h5>
                            <p>{{ $dates->date }}</p>
                        </li>
                        <li>
                            <h5><b>Hora de inicio :</b></h5>
                            <p>{{ $dates->start_time }}</p>
                        </li>
                        <li>
                            <h5><b>Hora fin :</b></h5>
                            <p>{{ $dates->end_time }}</p>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>  
</div>
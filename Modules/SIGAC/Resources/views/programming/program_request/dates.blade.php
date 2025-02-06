<div class="modal fade" id="dates{{$prom->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">{{ trans('Programación')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($prom->groupedDates->isNotEmpty())
                    @foreach($prom->groupedDates as $date => $sessions)
                        <h5><b>Fecha: {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</b></h5>
                        <ul>
                            @foreach($sessions as $session)
                                <li>
                                    <h6><b>Hora de inicio:</b> {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}</h6>
                                    <h6><b>Hora fin:</b> {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</h6>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @else
                    <p>No hay fechas programadas.</p>
                @endif
            </div>
        </div>
    </div>  
</div>

<div class="modal fade" id="dates{{$prom->id}}" tabindex="-1" aria-labelledby="dates" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">{{ trans('Programación')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($prom->groupedDates as $timeRange => $datesGroup)
                    <h4><b>Programación : {{ $loop->iteration }}</b></h4>
                    <ul>
                        <li>
                            <h5><b>Fechas :</b></h5>
                            <p>
                                @foreach($datesGroup as $date)
                                    {{ \Carbon\Carbon::parse($date->date)->format('d-m-y') }}<br>
                                @endforeach
                            </p>
                        </li>
                        <li>
                            <h5><b>Hora de inicio :</b></h5>
                            <p>{{ $datesGroup->first()->start_time }}</p>
                        </li>
                        <li>
                            <h5><b>Hora fin :</b></h5>
                            <p>{{ $datesGroup->first()->end_time }}</p>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>  
</div>
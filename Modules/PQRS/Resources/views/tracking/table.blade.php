<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('pqrs::tracking.pqrs_monitoring') }}</h3>            
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('pqrs.tracking.create') }}">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPQRS" title="{{ trans('pqrs::tracking.add_pqrs') }}">
                                    <i class="fas fa-plus-circle fa-fw"></i>
                                </button>
                            </a>
                        </div>
                        <div class="col">
                            {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.email')]) !!}
                                <button type="submit" class="btn btn-info email" title="{{ trans('pqrs::tracking.send_alert_email') }}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col">
                            <a href="{{ route('pqrs.tracking.excel') }}">
                                <button class="btn btn-success excel" title="{{ trans('pqrs::tracking.load_excel') }}">
                                    <i class="fas fa-file-excel"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="mtop16">
                        <table id="tracking" class="table table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('pqrs::tracking.filing_number') }}</th>
                                    <th>{{ trans('pqrs::tracking.filing_date') }}</th>
                                    <th>{{ trans('pqrs::tracking.response_deadline') }}</th>
                                    <th>{{ trans('pqrs::tracking.issue') }}</th>
                                    <th>{{ trans('pqrs::tracking.official') }}</th>
                                    <th>{{ trans('pqrs::tracking.state') }}</th>
                                    <th>{{ trans('pqrs::tracking.description_subject') }}</th>
                                    <th>{{ trans('pqrs::tracking.response_filing_number') }}</th>
                                    <th>{{ trans('pqrs::tracking.actions') }}</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pqrs as $p)  
                                    <tr class="{{ $p->state == 'PROXIMA A VENCER' ? 'row-yellow' : '' }}">
                                        <td>{{ $p->filing_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->filing_date)->format('d-m-y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->end_date)->format('d-m-y') }}</td>
                                        <td>{{ $p->type_pqrs->name }}</td>
                                        <td>     
                                            @php
                                                $filtered = $p->people->filter(function($person) {
                                                    return $person->pivot->type == 'Funcionario' && !is_null($person->pivot->date_time);
                                                });
                                                $maxDate = $filtered->max('pivot.date_time');

                                                // Encontrar la persona que tiene la fecha mayor
                                                $personWithMaxDate = $filtered->first(function($person) use ($maxDate) {
                                                    return $person->pivot->date_time == $maxDate;
                                                });                                             
                                            @endphp                                     
                                            @if($personWithMaxDate)
                                                {{ $personWithMaxDate->first_name. ' ' . $personWithMaxDate->first_last_name . ' ' . $personWithMaxDate->second_last_name}}
                                            @endif                  
                                        </td>
                                        <td>{{ $p->state }}</td>
                                        <td>{{ Str::limit($p->issue, 10) }}</td>
                                        <td>
                                            @if(isset($p->filed_response))
                                                {{ $p->filed_response }}
                                            @else
                                                Sin radicado de respuesta.
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->state == 'EN PROCESO' || $p->state == 'PROXIMA A VENCER' || $p->state == 'RESPUESTA PARCIAL')
                                                <button type="button" class="btn btn-primary answer" data-bs-toggle="modal" data-bs-target="#answer{{ $p->id }}" title="{{ trans('pqrs::answer.reply') }} {{ $p->type_pqrs->name }}">
                                                    <i class="fas fa-retweet"></i>
                                                </button>    
                                                @if(isset($p->filed_response))
                                                @else
                                                    <button class="btn btn-info filing_response" data-bs-toggle="modal" data-bs-target="#filing{{ $p->id }}" title="{{ trans('pqrs::tracking.response_filing_of_the') }} {{ $p->type_pqrs->name }}">
                                                        <i class="fas fa-archive"></i>
                                                    </button>
                                                    @include('pqrs::tracking.filing_response')  
                                                @endif      
                                            @endif
                                            @include('pqrs::answer.create')
                                            @if ($p->state == 'RESPUESTA GENERADA' || $p->state == 'RESPUESTA PARCIAL')
                                                <button type="button" class="btn btn-warning info" data-bs-toggle="modal" data-bs-target="#info{{ $p->id }}" title="{{ trans('pqrs::tracking.information_of_the') }} {{ $p->type_pqrs->name }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>     
                                                @include('pqrs::answer.answer')
                                            @endif
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#history{{ $p->id }}" title="{{ trans('pqrs::tracking.history_of_the') }} {{ $p->type_pqrs->name }}">
                                                <i class="fas fa-history"></i>
                                            </button>    
                                            @include('pqrs::tracking.history')
                                           
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
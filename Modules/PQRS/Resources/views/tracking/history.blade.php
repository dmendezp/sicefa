<!-- Modal -->
<div class="modal fade" id="history{{ $p->id }}" tabindex="-1" aria-labelledby="history{{ $p->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="history{{ $p->id }}Label">{{ trans('pqrs::tracking.assignment_history') }} {{ $p->type_pqrs->name }}</h1>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><strong>NIS: </strong>{{ $p->nis }}</p>
                        <p><strong>{{ trans('pqrs::tracking.description') }}: </strong>{{ $p->issue }}</p>
                    </div>
                    <div class="col-12">
                        <table class="table table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('pqrs::tracking.name') }}</th>
                                    <th>{{ trans('pqrs::tracking.type') }}</th>
                                    <th>{{ trans('pqrs::tracking.date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $peopleSorted = $p->people->sortBy(function($person) {
                                        return $person->pivot->date_time;
                                    });
                                @endphp
                                @foreach ($peopleSorted as $official)
                                <tr>
                                    <td>{{ $official->first_name . ' ' . $official->first_last_name . ' ' . $official->second_last_name }}</td>
                                    <td>{{ $official->pivot->type }}</td>
                                    <td>{{ $official->pivot->date_time }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('pqrs::tracking.close') }}</button>
        </div>
      </div>
    </div>
</div>
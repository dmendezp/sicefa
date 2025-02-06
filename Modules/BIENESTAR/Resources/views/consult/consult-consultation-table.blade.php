<div class="row justify-content-md-center pt-4">
    <div class="card shadow col-md-14">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ trans('bienestar::consult.Document') }}</th>
                            <th>{{ trans('bienestar::consult.Name') }}</th>
                            <th>{{ trans('bienestar::consult.first_name') }}</th>
                            <th>{{ trans('bienestar::consult.second_last_name') }}</th>
                            <th>{{ trans('bienestar::consult.code') }}</th>
                            <th>{{ trans('bienestar::consult.course') }}</th>
                            <th>{{ trans('bienestar::consult.status') }}</th>
                            <th>{{ trans('bienestar::consult.benefit') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $item)
                        <tr>
                            <td>{{ $item->document_number }}</td>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->first_last_name }}</td>
                            <td>{{ $item->second_last_name }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->state }}</td>
                            <td>{{ $item->benefit_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
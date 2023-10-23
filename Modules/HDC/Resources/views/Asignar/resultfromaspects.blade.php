@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('cefa.hdc.table') }}">{{ trans('hdc::assign_environmental_aspects.title_card_records-saver') }}</a></li>
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-succes card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>{{ trans('hdc::assign_environmental_aspects.title_card_records-saver') }}</strong></h2>
            </div>

            <div class="table-body">
                <a href="{{ route('cefa.hdc.assign_environmental_aspects') }}" class="btn btn-success mb-2">
                    <i class="fa fas-solid fa-plus"></i>
                </a>

                <div class="tbale-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dato as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->activity->productive_unit->name }}</td>
                                    <td>{{ $d->activity->name }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
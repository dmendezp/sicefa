@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ trans('cpd::metadata.Breadcrumb_Metadata') }}</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-10 mx-auto">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ $view['titleView'] }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="table-producers" class="table table-bordered table-sm dtr-inline">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">{{ trans('cpd::metadata.1T_Group') }}</th>
                                                <th class="align-middle text-center">{{ trans('cpd::metadata.1T_Abbreviation') }}</th>
                                                <th class="align-middle text-center">{{ trans('cpd::metadata.1T_Metadata') }}</th>
                                                <th class="align-middle text-center">{{ trans('cpd::metadata.1T_Unit') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <td rowspan="{{ $data->metadatas->count() + 1 }}" class="align-middle text-center">{{ $data->name }}</td>
                                                </tr>
                                                @if($data->metadatas->count())
                                                    @foreach ($data->metadatas as $metadata)
                                                        <tr>
                                                            <td class="align-middle">{{ $metadata->abbreviation }}</td>
                                                            <td class="align-middle">{{ $metadata->description }}</td>
                                                            <td class="align-middle">{{ $metadata->unit_measure }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')

@endsection

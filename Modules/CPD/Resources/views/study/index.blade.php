@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ trans('cpd::monitoring.Breadcrumb_Monitoring') }}</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h4 class="m-0"><b>{{ $view['titleView'] }}</b></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="table-studies" class="table table-bordered table-striped table-sm dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" class="text-center" >
                                                        <a href="{{ route('cpd.admin.study.create') }}" class="text-primary" class="text-primary" data-toggle='tooltip' data-placement="top" title="{{ trans('cpd::monitoring.T_Register_Monitoring') }}" style="font-size: 20px;">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </a>
                                                    </th>
                                                    <th rowspan="2" class="align-middle text-center">{{ trans('cpd::monitoring.1T_Number') }}</th>
                                                    <th rowspan="2" class="align-middle text-center">{{ trans('cpd::monitoring.1T_Producer') }}</th>
                                                    <th rowspan="2" class="align-middle text-center">{{ trans('cpd::monitoring.1T_Monitoring') }}</th>
                                                    <th rowspan="2" class="align-middle text-center">{{ trans('cpd::monitoring.1T_Municipality_Village') }}</th>
                                                    <th rowspan="2" class="align-middle text-center">{{ trans('cpd::monitoring.1T_Typology') }}</th>
                                                    <th rowspan="2" class="align-middle text-center">{{ trans('cpd::monitoring.1T_Altitude') }}</th>
                                                    @foreach ($datas as $data)
                                                        <th colspan="{{ $data->metadatas->count() }}">{{ $data->name }}</th>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <th class="align-middle text-center">{{ trans('cpd::monitoring.1T_Actions') }}</th>
                                                    @foreach ($datas as $data)
                                                        @if($data->metadatas->count())
                                                            @foreach ($data->metadatas as $metadata)
                                                                <th class="text-center" data-toggle='tooltip' data-placement="top" title="{{ $metadata->description }} ({{ $metadata->unit_measure }})">{{ $metadata->abbreviation }}</th>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studies as $study)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('cpd.admin.study.show', $study->id) }}')">
                                                                <b class="text-info" data-toggle="tooltip" data-placement="top" title="{{ trans('cpd::monitoring.T_View_Monitoring') }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </b>
                                                            </a>
                                                            <a href="{{ route('cpd.admin.study.edit', $study->id) }}" class="text-success"  data-toggle='tooltip' data-placement="top" title="{{ trans('cpd::monitoring.T_Edit_Monitoring') }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('cpd.admin.study.delete', $study->id) }}')">     
                                                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('cpd::monitoring.T_Delete_Monitoring') }}">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </b>
                                                            </a>
                                                        </td>
                                                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $study->producer->name }}</td>
                                                        <td class="align-middle text-center">{{ $study->monitoring }}</td>
                                                        <td class="align-middle">{{ $study->village->VillMun }}</td>
                                                        <td class="align-middle">{{ $study->typology }}</td>
                                                        <td class="align-middle text-center">{{ $study->altitud }}</td>
                                                        @foreach ($datas as $data)
                                                            @if($data->metadatas->count())
                                                                @foreach ($data->metadatas as $metadata)
                                                                    @php $ab = $metadata->abbreviation; @endphp
                                                                    <td class="align-middle text-center" data-toggle='tooltip' data-placement="top" title="{{ $ab }} ({{ $metadata->unit_measure }})">{{ $study->$ab }}</td>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- General modal -->
    <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-content"></div>
        </div>
    </div>
    <div id="loader" style="display: none;"> {{-- Loader modal --}}
        <div class="modal-body text-center" id="modal-loader">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div><br>
            <b id="loader-message"></b>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('cpd/js/tables.js') }}"></script> {{-- Import settings for tables with Datatables --}}
    <script src="{{ asset('cpd/js/ajax.js') }}"></script> {{-- Import settings for modals with ajax consult --}}

    <script>
        $(function () {
            $('#table-studies').DataTable({
                language: language_datatables,
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10', '25', '50', 'Todas' ]
                ],
                scrollX: true, "lengthChange": true, "buttons": [/* "copy", "csv", "excel", "pdf", "print" */
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: ['{{ trans('cpd::monitoring.TB_Show_Hide') }}']},
                    {
                        extend: 'colvisGroup',
                        text: '{{ trans('cpd::monitoring.TB_Physicochemist') }}',
                        show: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27],
                        hide: [28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51],
                    },
                    {
                        extend: 'colvisGroup',
                        text: '{{ trans('cpd::monitoring.TB_Biota') }}',
                        show: [1,2,3,4,5,6,28,29,30,31,32,33,34],
                        hide: [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51],
                    },
                    {
                        extend: 'colvisGroup',
                        text: '{{ trans('cpd::monitoring.TB_Farming') }}',
                        show: [1,2,3,4,5,6,35,36,37,38,39,40],
                        hide: [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,41,42,43,44,45,46,47,48,49,50,51],
                    },
                    {
                        extend: 'colvisGroup',
                        text: '{{ trans('cpd::monitoring.TB_Weather') }}',
                        show: [1,2,3,4,5,6,41,42,43,44,45,46,47,48,49,50,51],
                        hide: [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40],
                    },
                    {
                        extend: 'colvisGroup',
                        text: '{{ trans('cpd::monitoring.TB_All') }}',
                        show: ':hidden'
                    }
                ],
                columnDefs: [
                    { orderable: false, targets: 0 }
                ],
                order: [[1, 'asc']]
            }).buttons().container().appendTo('#table-studies_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection

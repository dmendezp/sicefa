@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ trans('cpd::producer.Breadcrumb_Producers') }}</li>
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
                                    <table id="table-producers" class="table table-bordered table-striped table-sm dtr-inline">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">{{ trans('cpd::producer.1T_Number') }}</th>
                                                <th class="align-middle text-center">{{ trans('cpd::producer.1T_Producer') }}</th>
                                                <th class="text-center" >
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('cpd.admin.producer.create') }}')">
                                                        <b class="btn btn-primary py-0 px-1 btn-sm" data-toggle="tooltip" data-placement="top" title="{{ trans('cpd::producer.T_Register_Producer') }}">
                                                            <i class="fas fa-plus-circle"></i>
                                                            {{ trans('cpd::producer.Btn_Register') }}
                                                        </b>
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($producers as $producer)
                                                <tr>
                                                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $producer->name }}</td>
                                                    <td class="align-middle text-center">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('cpd.admin.producer.edit', $producer->id) }}')">
                                                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="{{ trans('cpd::producer.T_Edit_Producer') }}">
                                                                <i class="far fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('{{ route('cpd.admin.producer.delete', $producer->id) }}')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('cpd::producer.T_Delete_Producer') }}">
                                                                <i class="far fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    </td>
                                                </tr>
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

    <!-- General modal -->
    <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
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
            $('#table-producers').DataTable({
                language: language_datatables,
                lengthMenu: [
                    [5, 10, 20, -1 ],
                    ['5', '10', '20', 'Todas' ]
                ],
                columnDefs: [
                    { orderable: false, targets: 2 }
                ]
            })
        });

        function titleCase(texto) { /* Convert the parameter to text title Case */
            const re = /(^|[^A-Za-zÁÉÍÓÚÜÑáéíóúüñ])(?:([a-záéíóúüñ])|([A-ZÁÉÍÓÚÜÑ]))|([A-ZÁÉÍÓÚÜÑ]+)/gu;
            return texto.replace(re,
                (m, caracterPrevio, minuscInicial, mayuscInicial, mayuscIntermedias) => {
                    const locale = ['es', 'gl', 'ca', 'pt', 'en'];
                    if (mayuscIntermedias)
                        return mayuscIntermedias.toLocaleLowerCase(locale);
                    return caracterPrevio
                        + (minuscInicial ? minuscInicial.toLocaleUpperCase(locale) : mayuscInicial);
                }
            );
        }

        function mayus(e) { /* Convert the content of a field to title Case */
            e.value = titleCase(e.value);
        }
    </script>
@endsection

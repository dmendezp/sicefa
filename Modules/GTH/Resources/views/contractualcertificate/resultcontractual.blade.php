
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">{{ trans('gth::menu.Contract reports') }}</h1>
                        <table id="contractor" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Numero Contrato</th>
                                    <th scope="col">{{ trans('gth::menu.ID number') }}</th>
                                    <th scope="col">{{ trans('gth::menu.Full name') }}</th>
                                    <th scope="col">Fecha inicio</th>
                                    <th scope="col">Fecha fin</th>
                                    <th scope="col">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractors as $contract)
                                    <tr>
                                        <td>{{ $contract->contract_number }}</td>
                                        <td>{{ $contract->person->document_number }}</td>
                                        <td>{{ $contract->person->full_name }}</td>
                                        <td>{{ $contract->contract_start_date }}</td>
                                        <td>{{ $contract->contract_end_date }}</td>
                                        <td>
                                            <a id="pdf" href="{{ route('cefa.contractualcertificate.pdf', ['id' => $contract->id]) }}" class="btn btn-danger" target="_blank">
                                                Exportar PDF<i class="fa-solid fa-file-pdf"></i>
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
    </div>


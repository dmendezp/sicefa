@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">Monitoreos</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ $view['titleView'] }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                <table id="table-studies" class="table table-bordered table-striped table-sm dtr-inline">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="align-middle text-center"  width="50px">
                                                <a href="{{ route('cefa.cpd.admin.study.add') }}" class="text-primary" class="text-primary" data-toggle='tooltip' data-placement="top" title="Registrar monitoreo" style="font-size: 20px;">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                            </th>
                                            <th rowspan="2" class="align-middle text-center">#</th>
                                            <th rowspan="2" class="align-middle text-center">Productor</th>
                                            <th rowspan="2" class="align-middle text-center">Monitoreo</th>
                                            <th rowspan="2" class="align-middle text-center">Municipio / Vereda</th>
                                            <th rowspan="2" class="align-middle text-center">Tipología</th>
                                            <th rowspan="2" class="align-middle text-center">Altitud</th>
                                            @foreach ($datas as $data)
                                                <th colspan="{{ $data->metadatas->count() }}">{{ $data->name }}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            @foreach ($datas as $data)
                                                @if($data->metadatas->count())
                                                    @foreach ($data->metadatas as $metadata)
                                                        <th class="text-center">{{ $metadata->abbreviation }}</th>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studies as $study)
                                            <tr>
                                                <td class="align-middle text-center" width="50px">
                                                    <a href="" class="text-info"  data-toggle='tooltip' data-placement="top" title="Ver detalle de monitoreo">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="" class="text-success"  data-toggle='tooltip' data-placement="top" title="Actualizar monitoreo">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="text-danger btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" title="Eliminar monitoreo">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $study->producer->name }}</td>
                                                <td class="align-middle text-center">{{ $study->monitoring }}</td>
                                                <td class="align-middle">{{ $study->village->getVillMunAttribute() }}</td>
                                                <td class="align-middle">{{ $study->typology }}</td>
                                                <td class="align-middle text-center">{{ $study->altitud }}</td>
                                                @foreach ($datas as $data)
                                                    @if($data->metadatas->count())
                                                        @foreach ($data->metadatas as $metadata)
                                                            @php
                                                                $ab = $metadata->abbreviation;
                                                            @endphp
                                                            <td class="align-middle text-center ">{{ $study->$ab }}</td>
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
@endsection

@section('scripts')
<script>
    $(function () {
        $('#table-studies').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
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
                    text: ['Mostrar/Ocultar']},
                {
                    extend: 'colvisGroup',
                    text: 'Fisicoquímico',
                    show: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27],
                    hide: [28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51],
                },
                {
                    extend: 'colvisGroup',
                    text: 'Biota',
                    show: [1,2,3,4,5,6,28,29,30,31,32,33,34],
                    hide: [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51],
                },
                {
                    extend: 'colvisGroup',
                    text: 'Cultivo',
                    show: [1,2,3,4,5,6,35,36,37,38,39,40],
                    hide: [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,41,42,43,44,45,46,47,48,49,50,51],
                },
                {
                    extend: 'colvisGroup',
                    text: 'Clima',
                    show: [1,2,3,4,5,6,41,42,43,44,45,46,47,48,49,50,51],
                    hide: [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40],
                },
                {
                    extend: 'colvisGroup',
                    text: 'Todo',
                    show: ':hidden'
                }
            ]
        }).buttons().container().appendTo('#table-studies_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection

@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.sale.index') }}" class="text-decoration-none">Ventas</a></li>
    <li class="breadcrumb-item active">Hoy</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body pt-0">
            <div class="text-end my-2">
                <a href="{{ route('ptventa.sale.register') }}" class="btn btn-sm btn-success">
                    <i class="far fa-plus"></i>
                    Registrar Venta
                </a>
            </div>
            <div class="text-center text-danger" @if(count($sales)) hidden @endif>
                <strong>No hay ventas registradas</strong>
            </div>
            <div class="table-responsive"  @if(!count($sales)) hidden @endif>
                <table class="table table-hover" id="sales-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Comprobante</th>
                            <th>Cliente</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Valor</th> <!-- Agregada la clase text-center -->
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($sales as $s)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $s->voucher_number }}</td>
                                <td>{{ $s->movement_responsabilities->where('role','CLIENTE')->first()->person->full_name }}</td>
                                <td class="text-center">{{ $s->registration_date }}</td>
                                <td class="text-center">
                                    <b class="bg-{{ $s->state=='Aprobado' ? 'success' : 'warning'  }} text-dark rounded-5 px-2" style="font-size: 12px;">
                                        {{ $s->state }}
                                    </b>
                                </td>
                                <td class="text-center"><strong>{{ $s->price }}</strong></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-0" title="Ver detalles">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="5"><strong>Total de ventas:</strong></td>
                            <td class="text-center"><strong>{{$sales->sum('price')}}</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@include('ptventa::layouts.partials.plugins.sweetalert2')
@push('scripts')
    <script>
        $(document).ready(function () {
            // Configuración de Datatables para la tabla de registros de inventario
            $('#sales-table').DataTable({
                language: language_datatables, // Agregar traducción a español
                "order": [],
                "paging": false,
                "columnDefs": [{
                    "targets": [0,1,6],
                    "orderable": false
                }],
                drawCallback: function(settings) {
                    var api = this.api();
                    // Recalcula los números iterados en la primera columna después de cada redibujado
                    api.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            });
        });
    </script>
    @if (session('error'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
        });
    </script>
@endif

@endpush

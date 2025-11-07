@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.sale.index') }}" class="text-decoration-none">{{ trans('ptventa::sales.Breadcrumb_Sales_1') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('ptventa::sales.Breadcrumb_Active_Sales_1') }}</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm" data-aos="zoom-in">
        <div class="card-body pt-0">
            <div class="text-end my-2">
                @if (Auth::user()->havePermission('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.sale.register'))
                    <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.sale.register') }}"
                        class="btn btn-sm btn-success">
                        <i class="fa-solid fa-plus fa-fade"></i>
                        {{ trans('ptventa::sales.Btn_Register_Sale') }}
                    </a>
                @endif
            </div>
            @if ($cashCount)
                <div class="table-responsive" @if (!count($sales)) hidden @endif>
                    <table class="table table-hover" id="sales-table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">{{ trans('ptventa::sales.1T_Number') }}</th>
                                <th class="text-center">{{ trans('ptventa::sales.1T_Voucher') }}</th>
                                <th>{{ trans('ptventa::sales.1T_Client') }}</th>
                                <th class="text-center">{{ trans('ptventa::sales.1T_Date') }}</th>
                                <th class="text-center">{{ trans('ptventa::sales.1T_State') }}</th>
                                <th class="text-center">{{ trans('ptventa::sales.1T_Value') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($sales as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $s->voucher_number }}</td>
                                    <td>{{ $s->movement_responsibilities->where('role', 'CLIENTE')->first()->person->full_name }}
                                    </td>
                                    <td class="text-center">{{ $s->registration_date }}</td>
                                    <td class="text-center">
                                        <b class="bg-{{ $s->state == 'Aprobado' ? 'success' : 'warning' }} text-dark rounded-5 px-2" style="font-size: 12px;">
                                            {{ $s->state }}
                                        </b>
                                    </td>
                                    <td class="text-center"><strong>{{ priceFormat($s->price) }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="5">
                                    <h3><strong>{{ trans('ptventa::sales.1T_Total') }}</strong></h3>
                                </td>
                                <td class="text-center text-success">
                                    <h3><strong>{{ priceFormat($sales->sum('price')) }}</strong></h3>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center text-danger" @if (count($sales)) hidden @endif>
                    <strong>{{ trans('ptventa::sales.Text_Optional_1') }}</strong>
                </div>
            @else
                <div class="text-center text-danger">
                    <strong>{{ trans('ptventa::sales.Text_Optional_2') }}</strong>
                </div>
            @endif
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@include('ptventa::layouts.partials.plugins.sweetalert2')
@push('scripts')

    <script>
        $(document).ready(function() {
            
            // Opciones comunes para todas las tablas DataTable
            var dataTableOptions = {
                "order": [],
                "paging": false,
                "columnDefs": [{
                    "targets": [0, 1],
                    "orderable": false
                }],
                drawCallback: function(settings) {
                    var api = this.api();
                    // Recalcula los números iterados en la primera columna después de cada redibujado
                    api.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            };

            // Verificar el idioma actual y decidir si agregar la opción de idioma
            if ('{{ session('lang') }}' === 'es') {
                dataTableOptions.language = language_datatables;
            }

            // Inicializar DataTables con las opciones configuradas
            $('#sales-table').DataTable(dataTableOptions);
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

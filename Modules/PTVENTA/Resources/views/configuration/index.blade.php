@extends('ptventa::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::configuration.Breadcrumb_Active_configuration') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ trans('ptventa::configuration.Title_Card_Ticket') }}</h4>
                            <p>{{ trans('ptventa::configuration.Text_Card_Ticket') }}</p>
                            @if (Auth::user()->havePermission(
                                    'ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.configuration.postprinting'))
                                <button class="btn btn-success"
                                    id="imprimirBtn">{{ trans('ptventa::configuration.Btn_Generate_Ticket') }}
                                    <i class="fa-solid fa-ticket"></i>
                                </button>
                            @endif
                        </div>
                        <div class="col-md-4 position-relative">
                            <div class="position-absolute start-0 top-0 bottom-0 bg-gradient-fade"></div>
                            <img class="img-fluid" src="{{ asset('modules/ptventa/images/general/ticket.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')

@push('scripts')
    {{-- Ruta de la estructura fuente del plugin de Parzibyte - Impresoras termicas v3 --}}
    <script src="{{ asset('modules/ptventa/js/sale/conector_javascript_POS80C.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async () => {

            const conector = new ConectorPluginV3();
            conector.Iniciar();
            conector.EstablecerTamañoFuente(1, 1);
            conector.EstablecerEnfatizado(false);
            conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
            conector.Corte(1);
            conector.TextoSegunPaginaDeCodigos(2, "cp850", "CENTRO DE FORMACIÓN AGROINDUSTRIAL\n")
            conector.DeshabilitarElModoDeCaracteresChinos();
            // Recuerda que si tu impresora soporta acentos sin configuración adicional solo debes invocar a EscribirTExto
            conector.EscribirTexto("La Angostura\n");
            conector.TextoSegunPaginaDeCodigos(2, "cp850", "Factura de venta N°: Prueba\n");
            conector.EscribirTexto("------------------------------------------------\n");
            conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
            conector.TextoSegunPaginaDeCodigos(2, "cp850", "Factura impresa exitosamente\n");
            conector.Feed(4);
            conector.Corte(1);
            const imprimirBtn = document.getElementById('imprimirBtn');
            imprimirBtn.addEventListener('click', async (event) => {
                event.preventDefault();

                // Intenta imprimir usando la impresora con nombre "POS-80C"
                respuesta = await conector.imprimirEn("POS-80C");
                if (respuesta === true) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Factura generada correctamente.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    alert(respuesta);
                }

            });
        });
    </script>
@endpush

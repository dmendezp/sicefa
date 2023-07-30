@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/custom_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::Configuration.Configuration') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>{{ trans('ptventa::Configuration.TitleCard1') }}</h4>
                    <p>{{ trans('ptventa::Configuration.TextCard1') }}</p>
                    <button class="btn btn-success" id="imprimirBtn">{{ trans('ptventa::Configuration.Btn1') }} <i
                            class="fa-solid fa-ticket"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')

@push('scripts')
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
            conector.TextoSegunPaginaDeCodigos(2, "cp850", "¡Bienvenido!");
            conector.Feed(4);
            conector.Corte(1);
            const imprimirBtn = document.getElementById('imprimirBtn');
            imprimirBtn.addEventListener('click', async (event) => {
                event.preventDefault();

                try {
                    // Intenta imprimir usando la impresora con nombre "POS-80C"
                    await conector.imprimirEn("POS-80C");

                    // Si la impresora esta disponible el resultado es exitoso
                    // Redireccionar al usuario a la vista del botón
                    window.location.href = "{{ route('cefa.ptventa.configuration') }}";
                } catch (error) {
                    // A ocurrido un error en la impresion
                    // Muestra el SweetAlert2 con la notificacion
                    Swal.fire({
                        icon: 'error',
                        title: '{{trans("ptventa::Configuration.title")}}',
                        text: '{{trans("ptventa::Configuration.text")}}',
                    });
                }
            });
        });
    </script>
@endpush

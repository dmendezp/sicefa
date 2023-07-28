@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/custom_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::mainPage.Main page') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Generar factura de prueba</h4>
                    <p>Aqui podras generar la factura de prueba para verificar su correcto funcionamiento, se usara en la generación de factura de venta y entrada de inventario.</p>
                    <button class="btn btn-success" id="imprimirBtn">Generar Factura <i class="fa-solid fa-ticket"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                await conector.imprimirEn("POS-80C");

                // Redireccionar al usuario a la vista del botón
                window.location.href = "{{ route('cefa.ptventa.configuration') }}";
            });
        });
    </script>
@endpush

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
    conector.TextoSegunPaginaDeCodigos(2, "cp850", "Factura N°: Prueba\n");
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
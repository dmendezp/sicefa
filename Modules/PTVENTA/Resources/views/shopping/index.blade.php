@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/image-gallery-styles.css') }}">
    @livewireStyles()
@endpush

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="card card-success card-outline col-12 mx-auto">
        <div class="card-body">
            @livewire('shopping')
        </div>
    </div>

    <div class="container-fluid">
        <button class="button-register-sale bg-success pt-2 pe-1" data-bs-toggle="modal" data-bs-target="#shoppingCartModal">
            <i class="fa-solid fa-cart-shopping fa-bounce"></i>
        </button>
    </div>

    <div class="modal fade" id="shoppingCartModal" tabindex="-1" aria-labelledby="shoppingCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <ul class="list-group" id="lista-productos-carrito"></ul>
                    <div class="mt-3 text-end">
                        <h5>Total: $<span id="total-carrito">0.00</span></h5>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" id="vaciarCarrito">Vaciar Carrito</button>
                    <button class="btn btn-primary" id="realizarCompra">Realizar Compra</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const botones = document.querySelectorAll('.agregar-al-carrito');
    const lista = document.getElementById('lista-productos-carrito');
    const totalCarrito = document.getElementById('total-carrito');
    const modal = new bootstrap.Modal(document.getElementById('shoppingCartModal'));
    const vaciarCarritoBtn = document.getElementById('vaciarCarrito');
    const realizarCompraBtn = document.getElementById('realizarCompra');

    const carrito = [];

    function actualizarTotal() {
        let total = 0;
        carrito.forEach(item => {
            total += item.precio * item.cantidad;
        });
        totalCarrito.textContent = formatearPrecio(total);
    }

    function renderizarCarrito() {
        lista.innerHTML = '';
        carrito.forEach((item, index) => {
            const li = document.createElement('li');
            li.classList.add('list-group-item');

            li.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${item.nombre}</strong><br>
                        Precio: $${formatearPrecio(item.precio)}<br>
                        Subtotal: $<span class="subtotal">${formatearPrecio(item.precio * item.cantidad)}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-danger" data-index="${index}" data-action="restar">-</button>
                        <span class="mx-2 cantidad">${item.cantidad}</span>
                        <button class="btn btn-sm btn-outline-success" data-index="${index}" data-action="sumar">+</button>
                        <button class="btn btn-sm btn-outline-danger ms-2" data-index="${index}" data-action="eliminar">🗑️</button>
                    </div>
                </div>
            `;
            lista.appendChild(li);
        });
        actualizarTotal();
    }

    botones.forEach(btn => {
        btn.addEventListener('click', function () {
            const nombre = this.dataset.name;
            const precio = parseFloat(this.dataset.price);

            const indexExistente = carrito.findIndex(p => p.nombre === nombre);

            if (indexExistente !== -1) {
                carrito[indexExistente].cantidad += 1;
            } else {
                carrito.push({ nombre, precio, cantidad: 1 });
            }

            renderizarCarrito();
            modal.show();
        });
    });

    lista.addEventListener('click', function (e) {
        if (e.target.tagName === 'BUTTON') {
            const index = parseInt(e.target.dataset.index);
            const action = e.target.dataset.action;

            if (action === 'sumar') {
                carrito[index].cantidad += 1;
            } else if (action === 'restar') {
                carrito[index].cantidad -= 1;
                if (carrito[index].cantidad <= 0) {
                    carrito.splice(index, 1);
                }
            } else if (action === 'eliminar') {
                carrito.splice(index, 1);
            }

            renderizarCarrito();
        }
    });

    vaciarCarritoBtn.addEventListener('click', function () {
        carrito.length = 0;
        renderizarCarrito();
    });

    realizarCompraBtn.addEventListener('click', function () {
        if (carrito.length === 0) {
            Swal.fire('Carrito vacío', 'Por favor, agrega productos al carrito.', 'warning');
            return;
        }

        Swal.fire({
            title: '¿Está seguro de realizar la compra?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, realizar compra!'
        }).then((result) => {
            if (result.isConfirmed) {
                generarPDF(carrito);

                console.log("Carrito que se enviará al backend:");
                console.log(JSON.stringify(carrito, null, 2));

                // Enviar datos para guardar en la tabla 'notificationes'
                fetch("{{ route('ptventa.guardar.notificacion') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        productos: carrito,
                        total: carrito.reduce((acc, item) => acc + item.precio * item.cantidad, 0)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Notificación guardada:', data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Compra registrada',
                        text: 'Los detalles de la compra han sido guardados.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    // Vaciar el carrito después de guardar la notificación
                    carrito.length = 0;
                    renderizarCarrito();
                })
                .catch(error => {
                    console.error('Error al guardar la notificación:', error);
                    Swal.fire('Error', 'Hubo un problema al guardar los detalles de la compra.', 'error');
                });
            }
        });
    });
});

function formatearPrecio(valor) {
    return valor.toLocaleString('es-CO', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
}

async function generarPDF(carrito) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const fecha = new Date();
    const fechaStr = fecha.toLocaleDateString('es-CO');
    const horaStr = fecha.toLocaleTimeString('es-CO');

    doc.setFontSize(18);
    doc.setTextColor(40, 40, 40);
    doc.text("Punto de ventas - SICEFA", 70, 20);
    doc.setFontSize(10);
    doc.setTextColor(80, 80, 80);
    doc.text(`Fecha: ${fechaStr}  Hora: ${horaStr}`, 140, 25);

    doc.setLineWidth(0.5);
    doc.line(10, 30, 200, 30);

    let y = 40;

    doc.setFillColor(240, 240, 240);
    doc.rect(10, y - 5, 190, 10, 'F');

    doc.setFont(undefined, 'bold');
    doc.text("Producto", 12, y);
    doc.text("Precio", 70, y);
    doc.text("Cantidad", 110, y);
    doc.text("Subtotal", 160, y);
    doc.setFont(undefined, 'normal');

    y += 10;

    let total = 0;

    carrito.forEach(item => {
        const subtotal = item.precio * item.cantidad;
        total += subtotal;

        doc.text(item.nombre, 12, y);
        doc.text(`$${formatearPrecio(item.precio)}`, 70, y);
        doc.text(`${item.cantidad}`, 115, y);
        doc.text(`$${formatearPrecio(subtotal)}`, 160, y);

        y += 10;
    });

    doc.setDrawColor(0);
    doc.line(10, y + 5, 200, y + 5);

    doc.setFont(undefined, 'bold');
    doc.setFontSize(14);
    doc.text(`Total: $${formatearPrecio(total)}`, 150, y + 15);

    window.open(doc.output('bloburl'), '_blank');
}
</script>
@livewireScripts()
@endpush
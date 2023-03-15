@extends('ptventa::layouts.master')

@section('style')

<style>
/* Loader */
.loader {
  color: rgb(255, 255, 255);
  font-family: "Poppins",sans-serif;
  font-weight: 500;
  font-size: 25px;
  -webkit-box-sizing: content-box;
  box-sizing: content-box;
  height: 40px;
  padding: 10px 10px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  border-radius: 8px;
}

.words {
  overflow: hidden;
}

.word {
  display: block;
  height: 100%;
  padding-left: 6px;
  color: #000000;
  animation: spin_4991 4s infinite;
}

@keyframes spin_4991 {
  10% {
    -webkit-transform: translateY(-105%);
    transform: translateY(-105%);
  }

  25% {
    -webkit-transform: translateY(-100%);
    transform: translateY(-100%);
  }

  35% {
    -webkit-transform: translateY(-205%);
    transform: translateY(-205%);
  }

  50% {
    -webkit-transform: translateY(-200%);
    transform: translateY(-200%);
  }

  60% {
    -webkit-transform: translateY(-305%);
    transform: translateY(-305%);
  }

  75% {
    -webkit-transform: translateY(-300%);
    transform: translateY(-300%);
  }

  85% {
    -webkit-transform: translateY(-405%);
    transform: translateY(-405%);
  }

  100% {
    -webkit-transform: translateY(-400%);
    transform: translateY(-400%);
  }
}

/* --------------- */

.loader-one {
  --cell-size: 52px;
  --cell-spacing: 1px;
  --cells: 3;
  --total-size: calc(var(--cells) * (var(--cell-size) + 2 * var(--cell-spacing)));
  display: flex;
  flex-wrap: wrap;
  width: var(--total-size);
  height: var(--total-size);
}

.cell {
  flex: 0 0 var(--cell-size);
  margin: var(--cell-spacing);
  background-color: transparent;
  box-sizing: border-box;
  border-radius: 4px;
  animation: 1.5s ripple ease infinite;
}

.cell.d-1 {
  animation-delay: 100ms;
}

.cell.d-2 {
  animation-delay: 200ms;
}

.cell.d-3 {
  animation-delay: 300ms;
}

.cell.d-4 {
  animation-delay: 400ms;
}

.cell:nth-child(1) {
  --cell-color: #00FF87;
}

.cell:nth-child(2) {
  --cell-color: #0CFD95;
}

.cell:nth-child(3) {
  --cell-color: #17FBA2;
}

.cell:nth-child(4) {
  --cell-color: #23F9B2;
}

.cell:nth-child(5) {
  --cell-color: #30F7C3;
}

.cell:nth-child(6) {
  --cell-color: #3DF5D4;
}

.cell:nth-child(7) {
  --cell-color: #45F4DE;
}

.cell:nth-child(8) {
  --cell-color: #53F1F0;
}

.cell:nth-child(9) {
  --cell-color: #60EFFF;
}

/*Animation*/
@keyframes ripple {
  0% {
    background-color: transparent;
  }

  30% {
    background-color: var(--cell-color);
  }

  60% {
    background-color: transparent;
  }

  100% {
    background-color: transparent;
  }
}
</style>

@endsection

@section('breadcrumb')
    {{-- The breadcrumb is the tracking af the displayed view --}}
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
    <li class="breadcrumb-item active">Página principal</li>
@endsection

@section('content')
<div class="card text-center mb-3 shadow-sm">

    <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
            <div>
                <h4 class="text-center">Productos más populares del centro de formación</h4>
                <p>Punto de venta es un sitio de administración para los productos que son exportados desde aqui para todo en centro de formación entre ellos tenemos como:</p>
            </div>
        </div>         

        <div class="d-flex justify-content-evenly mt-3">

            <div>
                <h6>Repostería</h6>
                <div class="card-products">
                    <img src="{{ asset('ptventa/images/Card1.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Donas</p>
                        <span>Crispy, Choco, Oreo y Chips</span>
                        <p class="text price">$2.000</p>
                    </div>
                </div>
            </div>

            <div>
                <h6>Lácteos</h6>
                <div class="card-products">
                    <img src="{{ asset('ptventa/images/Card2.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Leche</p>
                        <span>Producida en la unidad de ganaderia</span>
                        <p class="text price">$5.000 Lt</p>
                    </div>
                </div>
            </div>

            <div>
                <h6>Lácteos</h6>
                <div class="card-products">
                    <img src="{{ asset('ptventa/images/Card3.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Yogurt</p>
                        <span>Producido en el sector de Agroindustria</span>
                        <p class="text price">$5.000 Lt</p>
                    </div>
                </div>
            </div>

            <div>
                <h6>Verduras</h6>
                <div class="card-products">
                    <img src="{{ asset('ptventa/images/Card4.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Lechuga</p>
                        <span>Producida en los sectores de viveros</span>
                        <p class="text price">$6.000 Lt</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>
@endsection

@section('scripts')
<script>
    Swal.fire({
        html:
        '<div class="d-flex justify-content-center">' +
            '<div class="d-flex align-items-center">' +
                '<div class="loader-one">' +
                    '<div class="cell d-0"></div>' +
                    '<div class="cell d-1"></div>' +
                    '<div class="cell d-2"></div>' +
                    '<div class="cell d-1"></div>' +
                    '<div class="cell d-2"></div>' +
                    '<div class="cell d-2"></div>' +
                    '<div class="cell d-3"></div>' +
                    '<div class="cell d-3"></div>' +
                    '<div class="cell d-4"></div>' +
                '</div>' +
                '<div class="loader">' +
                    '<p>Cargando</p>' +
                    '<div class="words">' +
                        '<span class="word">Botones</span>' +
                        '<span class="word">Formularios</span>' +
                        '<span class="word">Cards</span>' +
                        '<span class="word">Vistas</span>' +
                        '<span class="word">Estilos</span>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>',
        background: '-webkit-linear-gradient(#132a13, #31572c, #4f772d, #90a955, #ecf39e)',
        backdrop: '-webkit-linear-gradient(#132a13, #31572c, #4f772d, #90a955, #ecf39e)',
        showConfirmButton: false,
        width: 50000,
        padding: '15em', // altura
        timer: 6000,
    })
</script>
@endsection

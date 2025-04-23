@php
    $view = ['titlePage' => 'Notificaciones'];
    $notificaciones = [
        [
            'productos' => json_encode([
                ['nombre' => 'PULPA DE FRUTAS X KL', 'cantidad' => 2, 'precio' => 10000],
                ['nombre' => 'MANDARINA', 'cantidad' => 1, 'precio' => 8000],
            ]),
            'total' => 18000,
            'created_at' => now()->subMinutes(10),
        ],
        [
            'productos' => json_encode([
                ['nombre' => 'LIMÓN TAHITÍ', 'cantidad' => 5, 'precio' => 1200],
            ]),
            'total' => 6000,
            'created_at' => now()->subHours(2),
        ],
    ];
@endphp

@extends('ptventa::layouts.master')

@section('content')
<div class="row" data-aos="fade-up" data-aos-duration="2500">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-bell"></i> Notificaciones de Compras</h3>
                <div class="card-tools">
                    <span class="badge badge-danger">{{ count($notificaciones) }} nuevas</span>
                </div>
            </div>

            <div class="card-body">
                @forelse ($notificaciones as $notificacion)
                    @php
                        $productos = json_decode($notificacion['productos'], true);
                    @endphp
                    <div class="alert alert-info">
                        <strong>Compra realizada:</strong><br>
                        <ul>
                            @foreach ($productos as $producto)
                                <li>{{ $producto['nombre'] }} - Cantidad: {{ $producto['cantidad'] }} - Precio: ${{ $producto['precio'] }}</li>
                            @endforeach
                        </ul>
                        <strong>Total de la compra:</strong> ${{ number_format($notificacion['total'], 0, ',', '.') }}
                        <br>
                        <small class="text-muted">Recibida {{ \Carbon\Carbon::parse($notificacion['created_at'])->diffForHumans() }}</small>
                    </div>
                @empty
                    <p>No hay notificaciones nuevas.</p>
                @endforelse
            </div>

            <div class="card-footer">
                @if (count($notificaciones) > 0)
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            Marcar todas como leídas
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

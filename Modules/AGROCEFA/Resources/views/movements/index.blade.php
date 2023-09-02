@extends('agrocefa::layouts.master')

@section('content')

<h2>Movimientos</h2>

<div class="container">
    <div class="row">
        <div class="col-md-6" style="width: 600px;margin-left: 60px">
            <a href="{{ route('agrocefa.formentrance') }}" class="card-link">
                <div class="card">
                    <h3>Entrada</h3>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('agrocefa.formexit') }}" class="card-link">
                <div class="card">
                    <h3>Salida</h3>
                </div>
            </a>
        </div>
    </div>
</div>

<style>

    /* Estilo para los enlaces */
    .card-link {
        text-decoration: none; /* Elimina la decoración de enlace (subrayado) */
        color: #333; /* Cambia el color del texto del enlace si es necesario */
    }

    .container{
        margin-top: 50px;
    }
    .card {
        box-sizing: border-box;
        width: 400px;
        height: 400px;
        background: rgba(217, 217, 217, 0.58);
        border: 1px solid rgb(255, 255, 255);
        box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
        backdrop-filter: blur(6px);
        border-radius: 17px;
        text-align: center;
        cursor: pointer;
        transition: all 0.5s;
        display: flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        font-weight: bolder;
        color: black;
    }

    .card:hover {
        transform: scale(1.05);
        background-color: rgba(171, 203, 228, 0.612)
    }

    .card:active {
        transform: scale(0.95) rotateZ(1.7deg);
    }
</style>
@endsection
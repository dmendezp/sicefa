@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Convocatoria</h1>
                </div>
                <div class="card-body">
                    <!-- Contenido de tu vista -->

                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Buscar...">
                        <button id="searchButton"><i class="fas fa-search"></i></button>
                    </div>
                    <ul id="searchResults"></ul>
                    <!-- Checklists Horizontales Centrados -->
                    <h2 class="text-center">¿Que beneficio</h2>
                    <div class="text-center">
                        <ul class="list-inline">
                            <li class="list-inline-item" style="margin-right: 200px">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"> Alimentacion
                                </label>
                            </li>
                            <li class="list-inline-item" style="margin-right: 200px">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"> Transporte
                                </label>
                            </li>
                            <li class="list-inline-item">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"> Internado
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Estilo para el campo de búsqueda y el botón */
    .search-container {
        display: flex;
        align-items: center;
    }

    input[type="text"] {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    button#searchButton {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        margin-left: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    button#searchButton:hover {
        background-color: #0056b3;
    }

    /* Estilo para los elementos de lista de checklist horizontal */
    .list-inline {
        padding-left: 0;
        list-style: none;
    }

    .list-inline-item {
        margin-right: 10px; /* Espacio entre los elementos del checklist */
    }
</style>
@endpush

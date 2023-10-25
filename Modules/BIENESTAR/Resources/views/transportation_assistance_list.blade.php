@extends('bienestar::layouts.master')

@section('content') 

    <h1>Asistencia De Transporte</h1> <h1><i class="fas fa-bus"></i></h1>

    <div class="container-fluid" style="max-width: 1200px;">
        <div class="row justify-content-md-center pt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                        <form class="form-inline d-flex align-items-center justify-content-center">
                            <div class="form-group">
                                <input type="number" class="form-control" id="search" placeholder="Buscar" pattern="[0-9]*">
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">Buscar</button>
                        </form>
                    </div>
                </div>
                <!-- Otro contenido de la vista va aquí -->
            </div>
        </div>
    </div>
    
@endsection

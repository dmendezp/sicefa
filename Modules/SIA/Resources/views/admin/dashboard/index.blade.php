@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Panel de Administración</h3>
                    </div>
                    <div class="card-body">
                        <p>Bienvenido al panel de administración del módulo SIA. Desde aquí puedes gestionar aprendices investigadores y otras funcionalidades del sistema.</p>
                        <a href="{{ route('sia.admin.apprentice_researcher.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Registrar Aprendiz Investigador
                        </a>
                        <a href="{{ route('sia.apprentice_researchers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list"></i> Ver Aprendices Investigadores
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
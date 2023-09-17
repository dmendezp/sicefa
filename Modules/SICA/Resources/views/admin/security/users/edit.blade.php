@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-10">
                    <div class="card-header">
                        <h4>Formulario de registro de usuario</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('sica.admin.security.users.update', $user) }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Nombre de la persona:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="full_name" value="{{ $user->person->full_name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nickname" class="col-md-4 col-form-label text-md-right">Nombre de usuario:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nickname" value="{{ $user->nickname }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico personal:</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="personal_email" value="{{ $user->email }}" disabled>
                                </div>
                            </div>

                            <div class="text-center">
                                <strong>Roles disponibles:</strong>
                            </div>
                            <div class="row justify-content-md-center mb-3">
                                @foreach ($apps as $app)
                                    <div class="col-md-3 border border-1 p-3 bg-light">
                                        <h5><i class="fas {{ $app->icon }} mr-2" style="color: {{ $app->color }}"></i>{{ $app->name }}</h5>
                                        @foreach ($app->roles->sortBy('name') as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" name="roles_id[]" type="checkbox" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-0 text-center">
                                <div class="col-md">
                                    <button type="submit" class="ml-2 btn btn-success">
                                        Actualizar usuario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

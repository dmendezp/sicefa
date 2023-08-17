@if($user)
    <form method="POST" action="{{ route('sica.admin.security.users.update', $user) }}">
@else
    <form method="POST" action="{{ route('sica.admin.security.users.store') }}">
@endif
    @csrf
    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">Nombre de la persona:</label>
        <div class="col-md-6 col-form-label">
            {{ $person->full_name }}
            <input type="hidden" class="form-control" name="person_id" value="{{ $person->id }}" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nickname" class="col-md-4 col-form-label text-md-right">Nombre de usuario:</label>
        <div class="col-md-6">
            <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $user ? $user->nickname : '' }}" {{ $user ? 'disabled' : 'required' }}>
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico personal:</label>
        <div class="col-md-6">
            <input id="personal_email" type="email" class="form-control" name="personal_email" value="{{ $user ? $user->email : $person->personal_email }}" {{ $user ? 'disabled' : 'required' }}>
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
                        <input class="form-check-input" name="roles_id[]" type="checkbox" value="{{ $role->id }}" {{ $user ? ($user->roles->contains($role->id) ? 'checked' : '') : '' }}>
                        <label class="form-check-label">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="row mb-0 text-center">
        <div class="col-md">
            @if($user)
            <button type="submit" class="ml-2 btn btn-success">
                Actualizar usuario
            </button>
            @else
                <a href="#" style="font-size: 12px" onclick="password_specifications()">¿Cómo se genera la contraseña?</a>
                <button type="submit" class="ml-2 btn btn-primary">
                    Registrar usuario
                </button>
            @endif
        </div>
    </div>
</form>

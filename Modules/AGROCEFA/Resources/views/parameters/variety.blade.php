{{-- CRUD Variety Parameter --}}
<div class="card">
    <div class="card-header">
        {{ trans('agrocefa::variety.variety') }}
        @auth
            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createVarieties"><i
                        class='bx bx-plus icon'></i></button>
            @endif
        @endauth
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('agrocefa::variety.name') }}</th>
                        <th>{{ trans('agrocefa::variety.specie') }}</th>
                        @auth
                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                <th>{{ trans('agrocefa::variety.Actions') }}</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($varieties as $variety)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $variety->name }}</td>
                            <td>{{ $variety->specie->name }}</td>
                            @auth
                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit-variety"
                                            data-bs-target="#editVarietyModal_{{ $variety->id }}" data-bs-toggle="modal">
                                            <i class='bx bx-edit icon'></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm btn-variety-specie" data-variety-id="{{ $variety->id }}">
                                            <i class='bx bx-trash icon'></i>
                                        </button>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                        {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.variety.destroy', 'id' => $variety->id], 'method' => 'DELETE', 'id' => 'delete-variety-form-' . $variety->id]) !!}
                        @csrf
                        @method('DELETE')
                        {!! Form::close() !!}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Create Variety Modal --}}
@foreach ($species as $specie)
    <div class="modal fade" id="createVarieties" tabindex="-1" aria-labelledby="createVarieties" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVarietyModalLabel">{{ trans('agrocefa::variety.create_varieties') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.variety.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('agrocefa::variety.name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="specie_id">{{ trans('agrocefa::variety.specie') }}</label>
                            {!! Form::select('specie_id', $species->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                        </div>                        
                        <br>
                        <button type="submit" class="btn standcolor">{{ trans('agrocefa::variety.create_varieties') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Delete Variety Modal --}}
@foreach ($varieties as $variety)
    <div class="modal fade" id="deleteVariety_{{ $variety->id }}" tabindex="-1"
        aria-labelledby="deleteVarietyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVarietyLabel">{{ trans('agrocefa::variety.Delete Variety') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ trans('agrocefa::variety.Delete Variety') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('agrocefa::variety.Cancel') }}</button>
                    {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.variety.destroy', 'id' => $variety->id], 'method' => 'DELETE']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit(trans('agrocefa::parameters.Delete'), ['class' => 'btn btn-danger','id' => 'standcolor']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($varieties as $v)
    <div class="modal fade" id="editVarietyModal_{{ $v->id }}" tabindex="-1"
        aria-labelledby="editVarietyModalLabel_{{ $v->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVarietyModalLabel_{{ $v->id }}">{{ trans('agrocefa::variety.Edit_Variety') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open([
                        'route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.variety.update', 'id' => $v->id],
                        'method' => 'POST',
                        'id' => "editVarietyForm_{$v->id}",
                    ]) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        {!! Form::label("name_{$v->id}", trans('agrocefa::variety.name')) !!}
                        {!! Form::text('name', $v->name, ['id' => "name_{$v->id}", 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="specie_id">{{ trans('agrocefa::variety.specie') }}</label>
                        {!! Form::select('specie_id', collect($species)->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                    </div>                    
                    <br>
                    {!! Form::submit(trans('agrocefa::variety.Update_Variety'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    $('.btn-edit-variety').on('click', function(event) {
        var modalTarget = $(this).data('bs-target');
        var varietyId = modalTarget.split('_')[1];

        console.log('Variety ID:', varietyId);

        var name = $('#name_' + varietyId).val();
        var specie = $('#specie_id_' + varietyId).val();

        $('#editVarietyForm_' + varietyId + ' #name').val(name);
        $('#editVarietyForm_' + varietyId + ' #specie_id').val(specie);

        var formAction = '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.variety.update', ['id' => 'VARIETY_ID']) }}';
        formAction = formAction.replace('VARIETY_ID', varietyId);

        $('#editVarietyForm_' + varietyId).attr('action', formAction);
    });

    $('.btn-variety-specie').on('click', function(event) {
        var varietyId = $(this).data('variety-id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-variety-form-' + varietyId).submit();
            }
        });
    });
</script>

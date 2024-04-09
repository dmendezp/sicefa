@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'sigac.academic_coordination.programming.management.store', 'method' => 'POST']) !!}
            @csrf
            <div class="form-group">
                {!! Form::label('course', 'Curso') !!}
                <div class="input-select">
                    {!! Form::select('course_id', $courses->pluck('program.name', 'id')->map(function ($item, $key) use ($courses) {
                        return $item . ' - ' . $courses->find($key)->code;
                    }), null, ['class' => 'form-select', 'placeholder' => 'Seleccione el curso','id'=> 'course']) !!}
                </div>
                @error('course')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#course').select2(); // Inicializa el campo course como select2

    });
</script>
    
@endpush

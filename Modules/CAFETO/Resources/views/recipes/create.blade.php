@extends('cafeto::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item"><a
            href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.index') }}"
            class="text-decoration-none">{{ trans('cafeto::recipes.Breadcrumb_Recipes_1') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('cafeto::recipes.Breadcrumb_Active_Register_Recipes_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="row mx-3 align-items-end">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>
                                    <strong class="text-danger">*</strong> {{ trans('cafeto::recipes.Title_Form_Owner') }}
                                </label>
                                {!! Form::hidden('person_id', Auth::user()->person_id) !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </span>
                                    </div>
                                    {!! Form::text('person_id', Auth::user()->person->full_name, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            {{-- Se incluye el componente livewire para seleccionar un producto para la receta --}}
                            @livewire('cafeto::recipe.select-product', ['formulation' => null])
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>
                                    <strong class="text-danger">*</strong>
                                    {{ trans('cafeto::recipes.Title_Form_Date_of_Creation') }}
                                </label>
                                {!! Form::date('date', \Carbon\Carbon::now()->toDateString(), [
                                    'class' => 'form-control text-center',
                                    'required',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>
                                    <strong class="text-danger">*</strong> {{ trans('cafeto::recipes.Title_Form_Amount') }}
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                    </div>
                                    {!! Form::number('amount', 1, ['class' => 'form-control text-center', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>
                                    <strong class="text-danger">*</strong>
                                    {{ trans('cafeto::recipes.Title_Form_Productive_Unit') }}
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                    </div>
                                    {!! Form::hidden('productive_unit_id', $productive_unit->id) !!}
                                    {!! Form::text('productive_unit_name', $productive_unit->name, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group my-0 mb-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                    </div>
                                    <div class="form-floating">
                                        {!! Form::textarea(null, null, [
                                            'class' => 'form-control',
                                            'style' => 'height: 124px',
                                            'placeholder' => 'Registre alguna observación',
                                        ]) !!}
                                        <label>
                                            <strong class="text-danger">*</strong>
                                            {{ trans('cafeto::recipes.Title_Form_Process') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>{{ trans('cafeto::recipes.Title_Form_Ingredents') }}</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                {!! Form::label(null, trans('cafeto::recipes.Title_Form_Measurement_Unit'), ['class' => 'mt-3']) !!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-list"></i>
                                                        </span>
                                                    </div>
                                                    <select id="inputState" class="form-select">
                                                        <option selected>{{ trans('cafeto::recipes.Select') }}</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::label(null, trans('cafeto::recipes.Title_Form_Element'), ['class' => 'mt-3']) !!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-list"></i>
                                                        </span>
                                                    </div>
                                                    <select id="inputState" class="form-select">
                                                        <option selected>{{ trans('cafeto::recipes.Select') }}</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                {!! Form::label(null, trans('cafeto::recipes.Title_Form_Amount'), ['class' => 'mt-3']) !!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-keyboard"></i>
                                                        </span>
                                                    </div>
                                                    {!! Form::text(null, null, [
                                                        'class' => 'form-control',
                                                        'required',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label mt-3">&nbsp;</label>
                                                <button type="button"
                                                    class="btn btn-outline-danger btn-sm btn-delete d-block">{{ trans('cafeto::recipes.Btn_Delete_Ingredent') }}</button>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 text-center">
                                                <button type="button"
                                                    class="btn btn-primary btn-sm-lg">{{ trans('cafeto::recipes.Btn_Add_Ingredent') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto mx-auto">
                            <button type="submit"
                                class="btn btn-success form-control text-truncate">{{ trans('cafeto::recipes.Btn_Create_Recipe') }}
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts()
@endpush

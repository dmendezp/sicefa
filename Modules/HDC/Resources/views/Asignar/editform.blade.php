@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"><a
            href=""></a>{{ trans('hdc::assign_environmental_aspects.Indicator_assign_environmental_aspects') }}</li>
@endpush


@section('content')
@if (session('register'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Actualizacion exitosa',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif
    <div class="">
        <div class="card card-green card-outline shadow col-12">
            <div class="card-header">
                <h3 class="card-title">{{ trans('hdc::assign_environmental_aspects.ct1') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('hdc.admin.update.EnvironmentalAspects') }}" method="post" id="updateForm">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ trans('hdc::assign_environmental_aspects.label1') }}</label>
                                <select name="productive_unit_id" id="productUnitSelect" class="form-control" required>
                                    <option
                                        value="{{ isset($activity->productive_unit) ? $activity->productive_unit->id : '' }}"
                                        selected>
                                        {{ isset($activity->productive_unit) ? $activity->productive_unit->name : '' }}
                                    </option>
                                    @foreach ($productive_units as $pro)
                                        <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label('activity', trans('hdc::assign_environmental_aspects.label2')) !!}
                                {!! Form::select('activity_id', [$activity->id => $activity->name], old('activity_id'), [
                                    'class' => 'form-control',
                                    'required',
                                    'id' => 'activity_id',
                                ]) !!}
                            </div>
                            <style>
                                .checklist {
                                    display: inline-block;
                                    margin-left: 20px;
                                }

                                label {
                                    display: block;
                                }
                            </style>
                        </div>

                        <div class="col-6">
                            <h2>{{ trans('hdc::assign_environmental_aspects.title_checklist') }}</h2>
                            <div name="Environmetal_Aspect" class="checkbox" required="true">
                                @foreach ($environmental_aspects as $key => $ea)
                                    <label for="Aspecto{{ $ea->id }}">
                                        <input type="checkbox" name="Environmental_Aspect[]"
                                            id="Aspecto{{ $ea->id }}" value="{{ $ea->id }}"
                                            {{ in_array($ea->id, $associated_environmental_aspects) ? 'checked' : '' }}>
                                        {{ $ea->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">
                                {{ trans('hdc::assign_environmental_aspects.btn1') }}
                            </button>
                        </div>
                    </div><br>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    @if (session('register'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Actualizacion exitosa',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endpush
@endsection

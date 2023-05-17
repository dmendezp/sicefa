@extends('ganaderia::layouts.master')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ trans('ganaderia::menu.animals') }}</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <select name="animal_id" class="form-control select2 select2-success" onchange="this.form.submit()" data-dropdown-css-class="select2-success" style="height: 100%;">
                                    <option value="">Selecciona</option>
                                    @foreach ($animals as $a)
                                        <option value="{{ $a->id }}" {{ $a->id == request('animal_id') ? 'selected' : '' }}>
                                            {{ $a->mother }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            @if($selectedAnimal)
                                <div>{{ $selectedAnimal->mother }} - {{ $selectedAnimal->weight }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>

@endsection
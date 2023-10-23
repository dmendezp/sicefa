@extends('agrocefa::partials.head')
@extends('agrocefa::partials.navbar')

@section('selectproductive')
<div class="container" style="margin-left: 20px">
    <h2>Unidades Productivas Disponibles</h2>
    <br>
    <div class="row">
        @if(isset($units) && $units->count() > 0)
            @foreach($units as $unit)
                <div class="col-md-4">
                    <div class="unit-card" data-unit-id="{{ $unit->id }}">
                        {{ $unit->name }}
                    </div>
                </div>
            @endforeach
        @else
            <p>No hay unidades productivas disponibles.</p>
        @endif
    </div>
</div>

<style>
    .unit-card {
        width: 300px;
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100px;
        font-size: 18px;
        cursor: pointer;
    }
</style>

<script>
    var baseUrl = "{{ url('/') }}";

    document.addEventListener('DOMContentLoaded', function() {
        const unitCards = document.querySelectorAll('.unit-card');

        unitCards.forEach(function(card) {
            card.addEventListener('click', function() {
                const unitId = card.getAttribute('data-unit-id');
                window.location.href = baseUrl + '/agrocefa/select-unit/' + unitId;
            });
        });
    });
</script>
@endsection

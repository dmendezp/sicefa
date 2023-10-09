@extends('agroindustria::layouts.master')
@section('content')

<div class="container">
        <h1>Registro de Equipos a Usar</h1>
        <form method="post" action="{{ route('cefa.agroindustria.units.instructor.equipment') }}">
            @csrf
            <div class="form-group">
                <label for="labor_id">Labor</label>
                <select name="labor_id" class="form-control">
                 <option value="">Seleccione una Labor</option>
                @foreach($laborInformation as $labor)
                    <option value="{{ $labor->id }}">{{ $labor->nombre }}</option>
                @endforeach
            </select>
        </div>
                    <div class="form-group">
                <label for="inventory_id">Equipo</label>
                <select name="inventory_id" id="inventory_id" class="form-control">
                    <option value="">Selecciona el equipo a usar</option>
                    @foreach($equipmentInformation as $equipment)
                        <option value="{{ $equipment->inventory->id }}" data-price="{{ $equipment->inventory->price }}" data-amount="{{ $equipment->inventory->amount }}">
                            ID: {{ $equipment->inventory->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">Precio</label>
                <input type="text" name="price" id="price" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="amount">Cantidad</label>
                <input type="text" name="amount" id="amount" class="form-control" readonly>
            </div>

            <script>
                $(document).ready(function() {
                $('#inventory_id').on('change', function() {
                var selectedOption = $(this).find(':selected');
                var price = selectedOption.data('price');
                var amount = selectedOption.data('amount');

                $('#price').val(price);
                $('#amount').val(amount);
        });
    });
</script>

@endsection
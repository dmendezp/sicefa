@extends('sipork::layouts.master')

@section('content')
<br><br><br>
<style>
    .form-card {
        background: #fefae0; /* Light beige, farm-inspired */
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #588157; /* Green border for farm theme */
        transition: transform 0.3s ease;
    }
    .form-card:hover {
        transform: translateY(-5px);
    }
    .form-card .card-header {
        background: linear-gradient(90deg, #3a5a40, #588157); /* Earthy green gradient */
        color: #fff;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
        font-size: 1.5rem;
        font-weight: 600;
    }
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center">
                        <h3 class="card-title mb-0 text-center flex-grow-1">Todos los Ciclos</h3>
                        <a href="{{ route('sipork.admin.sipork.ciclos_reproductivos.create') }}" class="btn btn-success btn-sm ml-auto" style="transition: all 0.3s ease; color: white;">Agregar Nuevo Ciclo</a>
                    </div>

                <div class="card-body">
                @if(session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: "{{ session('success') }}",
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            </script>
                        @endif
                        @if($reproductiveCycles->isEmpty())
                            <div class="alert alert-danger text-center">No hay registrados aún.</div>
                        @else
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Sow</th>
                                <th>Service Date</th>
                                <th>Birth Date</th>
                                <th>Live Piglets</th>
                                <th>Dead Piglets</th>
                                <th>Lactation End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reproductiveCycles as $cycle)
                                <tr>
                                    <td>{{ $cycle->id_cycle }}</td>
                                    <td>{{ $cycle->sow ? $cycle->sow->id_pig : 'N/A' }}</td>
                                    <td>{{ $cycle->service_date ?? 'N/A' }}</td>
                                    <td>{{ $cycle->birth_date ?? 'N/A' }}</td>
                                    <td>{{ $cycle->live_piglets ?? 'N/A' }}</td>
                                    <td>{{ $cycle->dead_piglets ?? 'N/A' }}</td>
                                    <td>{{ $cycle->lactation_end_date ?? 'N/A' }}</td>
                                    <td>
                                    <a href="" class="text-info" 
                                                        style="font-size: 1.5rem; transition: transform 0.3s ease, color 0.3s ease; color: #17a2b8;" 
                                                        onmouseover="this.style.transform='scale(1.2)'; this.style.color='darkcyan';" 
                                                        onmouseout="this.style.transform='scale(1)'; this.style.color='#17a2b8';">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('sipork.admin.sipork.ciclos_reproductivos.edit', $cycle->id_cycle) }}" class="text-warning" 
                                                        style="font-size: 1.5rem; transition: transform 0.3s ease, color 0.3s ease; color: #ffc107;" 
                                                        onmouseover="this.style.transform='scale(1.2)'; this.style.color='orange';" 
                                                        onmouseout="this.style.transform='scale(1)'; this.style.color='#ffc107';">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="" method="POST" style="display:inline;" onsubmit="return confirmDelete(this);">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" style="border: none; background: none; font-size: 1.5rem; transition: transform 0.3s ease, color 0.3s ease; color: red;" 
                                                            onmouseover="this.style.transform='scale(1.2)'; this.style.color='darkred';" 
                                                            onmouseout="this.style.transform='scale(1)'; this.style.color='red';" 
                                                            onclick="confirmDelete(this.form)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
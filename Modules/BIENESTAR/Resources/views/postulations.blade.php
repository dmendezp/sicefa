@extends('bienestar::layouts.adminlte')

@section('content')
    <div class="container">
        <h1>Postulaciones con Información de Aprendices</h1>
        <div class="container">
            <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Apprentice Name</th>
                    <th>Convocation</th>
                    <th>Type of Benefit</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postulations as $postulation)
                    <tr>
                        <td>{{ $postulation->id }}</td>
                        <td>{{ $postulation->apprentice->person->full_name }}</td>
                        <td>{{ $postulation->convocation->name }}</td>
                        <td>{{ $postulation->typesOfBenefits->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection

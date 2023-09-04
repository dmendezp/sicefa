@extends('bienestar::layouts.adminlte')

@section('content')

                        <h1 class="card-title">Convocatoria</h1>
                        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <!-- Aquí puedes agregar el contenido de tu vista -->
                        
                        <body>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar...">
        <button id="searchButton"><i class="fas fa-search"></i></button>
    </div>
    <ul id="searchResults"></ul>

    <script src="script.js"></script>
    <button type="submit" class="btn btn-success btn-block">Agregar pregunta</button>
</body>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

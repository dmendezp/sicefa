@extends('agrocefa::layouts.master')

@section('content')

<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    background-color: #8e02caf1;
    color: #fff;
    padding: 20px;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

label,
input,
select,
textarea {
    display: block;
    margin-bottom: 10px;
}

button {
    background-color: #ab08e2;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #740091e5;
}

#fertilizante-list {
    list-style-type: none;
    padding: 0;
}

.fertilizante-item {
    background-color: #f0f0f0;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.fertilizante-item h3 {
    margin: 0;
}

.fertilizante-item p {
    margin: 0;
}
    </style>
    <h1>Formulario de agroquimicos</h1>
    <form id="fertilizante-form">
        <label for="nombre">Nombre del agroquimico:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="tipo">Tipo de agroquimico:</label>
        <select id="tipo" name="tipo" required>
            <option value="nitrogeno">Nitrógeno</option>
            <option value="fosforo">Fósforo</option>
            <option value="potasio">Potasio</option>
            <option value="otros">Otros</option>
        </select>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        
        <button type="button" id="agregar">Agregar agroquimico</button>
    </form>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("agroquimico-form");
    const listaagroquimico = document.getElementById("agroquimico-list");

    formulario.addEventListener("submit", function (e) {
        e.preventDefault();
    });

    document.getElementById("agregar").addEventListener("click", function () {
        const nombre = document.getElementById("nombre").value;
        const tipo = document.getElementById("tipo").value;
        const descripcion = document.getElementById("descripcion").value;

        if (nombre && tipo && descripcion) {
            const nuevoFertilizante = document.createElement("li");
            nuevoagroquimico.classList.add("agroquimico-item");
            nuevoagroquimico.innerHTML = `
                <h3>${nombre}</h3>
                <p><strong>Tipo:</strong> ${tipo}</p>
                <p><strong>Descripción:</strong> ${descripcion}</p>
            `;

            listaagroquimico.appendChild(nuevoagroquimico);

            // Limpiar el formulario
            formulario.reset();
        } else {
            alert("Por favor, complete todos los campos del formulario.");
        }
    });
});

    </script>
</body>

@endsection

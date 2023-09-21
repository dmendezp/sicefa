// Espera a que el documento esté listo
$(document).ready(function() {
// Define la URL a la que deseas hacer la solicitud AJAX
var url = "https://ejemplo.com/api/datos";

// Realiza la solicitud AJAX utilizando jQuery
$.ajax({
type: "GET", // Puedes cambiar esto a "POST" u otros métodos según tus necesidades
url: url,
dataType: "json", // Especifica el tipo de datos que esperas recibir
success: function(data) {
// La función que se ejecutará si la solicitud es exitosa
console.log("Datos recibidos:", data);

// Aquí puedes manipular los datos y actualizar tu página web según sea necesario
},
error: function(jqXHR, textStatus, errorThrown) {
// La función que se ejecutará si la solicitud falla
console.error("Error en la solicitud AJAX:", errorThrown);
}
});
});

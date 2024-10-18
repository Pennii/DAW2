function modificar() {
    var parrafo = document.getElementById("mod");
    var contenedor = document.getElementById("contenedor");
    var nuevo = document.getElementById("orig")

    contenedor.replaceChild(nuevo, parrafo);
}

function borrar() {
    var parrafo = document.getElementById("bor");
    var contenedor = document.getElementById("contenedor");

    contenedor.removeChild(parrafo);
}
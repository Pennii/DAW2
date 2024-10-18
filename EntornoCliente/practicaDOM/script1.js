function generar(){
    var cont = document.getElementById("contenedor");
    var titulo = document.createElement("h1");
    var contenido = document.createTextNode("hola mundo");
    
    titulo.appendChild(contenido);
    cont.appendChild(titulo);
}

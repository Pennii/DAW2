addEventListener("pointermove",function(){
    var w = window.innerWidth;
    var h = window.innerHeight;
    var cont = document.getElementById("dimensiones");

    cont.innerHTML = `<h1>Ancho: ${w}, Altura: ${h} (cambia el tamaño de la pantalla y mueve el mouse)</h1>`;
}) 

function nueva(){
    window.open("index2.html");
}
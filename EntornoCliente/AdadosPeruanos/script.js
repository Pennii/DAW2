alert("prohibido canibales");

function enfoque(valor){
    var contenedores = document.getElementsByClassName('contenedor');

    for(var i = 0; i < contenedores.length; i++){
        contenedores[i].style.width = '25%';
    }

    document.getElementById(valor).style.width = '100%';
}
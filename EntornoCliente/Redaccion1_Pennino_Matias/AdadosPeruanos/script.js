alert("prohibido canibales");

function enfoque(valor) {
    var contenedores = document.getElementsByClassName('contenedor');
    document.getElementById(valor).style.width = '100%';
    setTimeout(() => {
    document.getElementById(valor).removeAttribute("style");
    }, 1000);
}
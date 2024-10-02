var valor = prompt("Ingresa un valor");
while(isNaN(valor)){
    alert("El valor ingresado no es un numero valido");
    valor = prompt("Ingresa otro valor");
}

if(valor > 5){
    document.write("<style>body{background-color: green;}</style>");
}else{
    document.write("<style>body{background-color: red;}</style>");
}

function cambio(){
    document.body.style.backgroundColor = "blue";
}

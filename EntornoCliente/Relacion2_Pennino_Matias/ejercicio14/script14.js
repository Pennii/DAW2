var numero = prompt("Ingresa el numero");
var convertido = "";
var restos = [];

//Si el numero es 0 entonces solo hay que imprimir 0
if(numero == 0){
    convertido = 0;
}
//Si el numero es superior entonces aplicaremos el teorema de la division para convertirlo
while(numero > 0){
restos.push(numero % 2);
numero = parseInt(numero / 2);
}

for(var i = restos.length - 1; i >= 0; i--){
    convertido += restos[i];
}
document.write(convertido);
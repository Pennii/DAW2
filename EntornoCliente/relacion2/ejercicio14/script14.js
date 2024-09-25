var numero = prompt("Ingresa el numero");
var transformado;
var restos = [];
transformado = "";
if(numero == 0){
    transformado = 0;
}
while(numero > 0){
restos.push(numero % 2);
numero = parseInt(numero / 2);
}

for(var i = restos.length - 1; i >= 0; i--){
    transformado += restos[i];
}
document.write(transformado);
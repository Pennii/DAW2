var palabra = prompt("Ingresa una palabra");
var reversa = "";
for(var i = palabra.length-1; i>=0; i--){
    reversa += palabra[i];
}
document.write("la palabra inversa es: "+reversa);
var palabra = prompt("Ingresa una palabra");
var reversa = "";
for(var i = palabra.length; i>0; i--){
    reversa += palabra[i-1];
}
document.write("la palabra inversa es: "+reversa);
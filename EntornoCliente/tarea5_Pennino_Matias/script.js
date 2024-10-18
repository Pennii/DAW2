//Ejercicio 1
var parrafos = document.getElementsByTagName("p");
console.log("numero de parrafos: "+parrafos.length);

//Ejercicio 2
if (parrafos.length >= 1) {
    var text = parrafos[1].innerText;
    console.log("El texto del segundo parrafo es: "+text);
}

//Ejercicio 3
var enlaces = document.getElementsByTagName("a");
console.log("numero de enlaces: " + enlaces.length);

//Ejercicio 4
var dirreccion = enlaces[0].href;
console.log("La direccion del primer enlace es: "+dirreccion);

//Ejercicio 5
var penultimo = "";
if (enlaces.length > 1) {
    penultimo = enlaces[enlaces.length - 2].href;
}else{
    penultimo = enlaces[enlaces.length-1].href;
}
console.log("La direccion del penultimo enlace es: "+penultimo);

//Ejercicio 6
var contador = 0;
for (let i = 0; i < enlaces.length; i++) {
    if (enlaces[i].href.endsWith("/wiki/municipio")) {
        contador++;
    }
}
console.log(contador + " enlaces llevan a /wiki/municipio");

//Ejercicio 7
var primer = parrafos[0].getElementsByTagName("a");
console.log("numero de enlaces en el primer parrafo: "+primer.length);
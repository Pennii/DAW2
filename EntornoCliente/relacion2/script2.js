var edad = prompt("ingresa tu edad");
var nombre = prompt("ingresa tu nombre");
var apellido = prompt("ingresa tu apellido");
var lugar = prompt("ingresa tu lugar de nacimiento");

document.write("nombre: " + nombre + "</br>");
document.write("apellido: " + apellido + "</br>");
document.write("edad: " + edad + "</br>");
document.write("lugar de nacimiento: " + lugar + "</br>");

var todo = nombre + " " + apellido;
document.write("nombre completo: " + todo);
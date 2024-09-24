var edad = prompt("Ingresa la edad del alumno");
var nombre = prompt("Ingresa el nombre del alumno");
var sexo = prompt("Ingresa el sexo del alumno");

if (edad >= 18) {
    document.write("<img src=\"carnet.webp\" width=90px height=90px></br>");
    document.write(nombre + " es mayor de edad y tiene un carnet para salir del centro</br>")
    document.write("datos:</br>")
    document.write("nombre: " + nombre + "</br>")
    document.write("edad: " + edad + "</br>")
    document.write("sexo: " + sexo + "</br>")
} else {
    document.write(nombre + " es menor de edad y no puede salir del centro</br>")
    document.write("nombre: " + nombre + "</br>")
    document.write("edad: " + edad + "</br>")
    document.write("sexo: " + sexo + "</br>")

}
var nom = prompt("Ingrese el nombre del alumno");
var nota = prompt("Ingrese la nota del alumno");
var resultado;

while (nota < 0 || nota > 10 || isNaN(nota)) {
    alert("Error al ingresar la nota");
    var nota = prompt("Ingrese la nota del alumno");
}

if(nota < 5){
    resultado = "Insuficiente";
}else if(nota < 6){
    resultado = "Aprobado";
}else if(nota < 7){
    resultado = "Bien";
}else if(nota < 8.5){
    resultado = "Notable";
}else if(nota <= 10){
    resultado = "Sobresaliente";
}

document.write("El resultado de " + nom + " en el modulo DWEC ha sido: "+resultado);
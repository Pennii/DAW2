var num, contador, media, max, suma, min;
contador = 0;
suma = 0;
do {
    num = parseInt(prompt("Ingresa un numero"));
    while (isNaN(num)) {
        alert("Error al ingresar numero")
        num = prompt("Ingresa un numero");
    }
    if (num != -1) {
        if (max == null || num > max) {
            max = num;
        }
        if (min == null || num < min) {
            min = num;
        }
        contador++;
        suma += num;
    }
} while (num != -1);

media = suma / contador;
document.write("La media de los numeros es: " + media + "</br>");
document.write("El numero maximo fue: " + max + " y el minimo: " + min);
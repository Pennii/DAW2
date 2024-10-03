var n = prompt("Ingresa la cantidad de numeros a calcular");
var cant, nums, contador;

document.write("Bucle for:</br>");
nums = 1;
//La cantidad de numeros empieza en 1 y llegara hasta n
for (var i = 2; nums <= n; i++) {
    cant = 0;
    //Cant es la cantidad de divisores que tiene un numero
    for (var j = 1; j <= i; j++) {
        if (i % j == 0) {
            cant++;
        }
    }
    //Si el numero es primo se imprime por pantalla y se aumenta la cantidad de numeros primos encontrados
    if (cant == 2) {
        document.write(i + " ");
        nums++;
    }
}

document.write("</br>Bucle while:</br>")
nums = 1;
contador = 2;
/*El bucle funciona de una manera similar al anterior, pero inicializamos un contador que empieza en 2 para
 poder contar hasta que se encuentren los n numeros primos*/
while (nums <= n) {
    cant = 0;
    for (var k = 1; k <= contador; k++) {
        if (contador % k == 0) {
            cant++;
        }
    }
    if (cant == 2) {
        document.write(contador + " ");
        nums++;
    }
    contador++;
}

document.write("</br>Bucle do while:</br>");
nums = 1;
contador = 2;
//La estructura del bucle while puede usarse para este otro bucle
do {
    cant = 0;
    for (var l = 1; l <= contador; l++) {
        if (contador % l == 0) {
            cant++;
        }
    }
    if (cant == 2) {
        document.write(contador + " ");
        nums++;
    }
    contador++;
} while (nums <= n);
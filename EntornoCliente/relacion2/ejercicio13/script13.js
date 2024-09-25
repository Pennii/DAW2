var n = prompt("Ingresa la cantidad de numeros a calcular");
var cant, nums, contador;

document.write("Bucle for:</br>");
nums = 1;
for (var i = 2; nums <= n; i++) {
    cant = 0;
    for (var j = 1; j <= i; j++) {
        if (i % j == 0) {
            cant++;
        }
    }
    if (cant == 2) {
        document.write(i + " ");
        nums++;
    }
}

document.write("</br>Bucle while:</br>")
nums = 1;
contador = 2;
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
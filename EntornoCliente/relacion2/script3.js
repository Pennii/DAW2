var num;
var cont = 1;

do{
    num = prompt("Ingresa un numero distinto a -1");
    if(isNaN(num)){
        document.write("El numero en la posicion " + cont+ " no es un numero valido</br>")
    }else{
        document.write("El numero de la posicion " + cont + " es: " + num + "</br>");
    }
    cont++;
} while(num != -1)
var num = prompt("Ingresa un numero");
if(!isNaN(num)){
    if(num % 2 == 0){
        document.write("Tu numero es par");
    }else{
        document.write("Tu numero es impar");
    }
}else{
    document.write("No has ingresado un numero");
}
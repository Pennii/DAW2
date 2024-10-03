var num = parseInt(prompt("Ingrese un numero"));
var num2;
do{
    num2 = parseInt(prompt("Ingresa un numero para adivinar"));
    if(num2 > num){
        alert("El numero que quieres adivinar es menor");
    }else if(num2 < num){
        alert("El numero que quieres adivinar es mayor")
    }
}while(num2 != num)

document.write("Has adivinado");
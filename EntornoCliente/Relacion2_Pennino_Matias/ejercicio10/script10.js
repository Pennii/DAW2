var num = parseFloat(prompt("Ingresa un numero"));
var num2 = parseFloat(prompt("Ingresa otro numero"));
var op, valida, resultado;
while(isNaN(num) || isNaN(num2)) {
    alert("ERROR AL INGRESAR NUMEROS")
    num = parseFloat(prompt("Ingresa un numero"));
    num2 = parseFloat(prompt("Ingresa otro numero"));
}

op = prompt("Ingresa la operacion");

valida = op == "+" || op == "-" || op == "*" || op == "/";

while (!valida) {
    alert("OPERACION INVALIDA")
    op = prompt("Ingresa la operacion");
    valida = op == "+" || op == "-" || op == "*" || op == "/";
}

switch (op) {
    case "+": resultado = num + num2; break;
    case "-": resultado = num - num2; break;
    case "*": resultado = num * num2; break;
    default: resultado = num / num2;
}

document.write("El resultado es: "+resultado);
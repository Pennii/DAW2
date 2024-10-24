function numeros(){
    var final = -1 //numero que termina la entrada de datos
    var num, media, max, min
    var cant = 0
    var sum = 0
    var salida
    alert(`ingresa numeros hasta que escribas ${final}`)
    //igualamos maximo y minimo al valor que nunca se evaluara
    max = final
    min = final
    do{
        num = parseInt(prompt("Ingresa un numero"))
        if (num != final && !isNaN(num)) { //verificamos si el numero es valido para calcular
            if (max == final || num > max) {
                max = num
            }
            if (min == final || num < min) {
                min = num
            }
            sum = sum + num
            cant++ 
        }
    }while(num != final)
    //si se ha ingresado al menos un numero valido mostraremos los resultados de las comprobaciones
    if (cant == 0) {
        salida = "no se han ingresado numeros para calcular"
    }else{
        media = sum / cant
        salida = `La media de los numeros es de: ${media}, el maximo fue: ${max} y el minimo: ${min}`
    }
    alert(salida)
}
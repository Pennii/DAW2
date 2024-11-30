function resolucion(ancho, alto){
    let salida
    if (ancho > 7680 && alto > 4320) {
        salida = "8k"
    }else if(ancho > 2560 && alto > 1440){
        salida = "4k"
    }else{
        salida = false
    }
    return salida
}
let res = resolucion(10,4321)
console.log(res)
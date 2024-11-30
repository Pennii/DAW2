function obtenerPorIndice(arr, indice) {
    let salida = indice >= 0 && arr[indice] ? arr[indice] : "Indice invalido"
    return salida
}
let arr = [1, 2, 3, 4]
arr[10]=7
console.log(obtenerPorIndice(arr, 10))
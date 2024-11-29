function minimoMaximo(arr){
    let min, max, resultado
    arr.sort((a,b)=>a-b)
    min = arr[0]
    max = arr[arr.length-1]
    console.log(arr)
    return [min,max]
}
let ejemplo = [15,32,0,14,2,78,-15]
console.log(minimoMaximo(ejemplo))

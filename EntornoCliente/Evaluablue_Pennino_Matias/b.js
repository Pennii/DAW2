
function crearArray() {
    var inicial = { make: "ford", model: "mustang", year: 1994 }

    let convertido = []
    claves = Object.keys(inicial)
    for (let i = 0; i < claves.length; i++) {
        let aux =[]
        aux[0] = claves[i]
        aux[1] = inicial[`${claves[i]}`]
        convertido.push(aux)
    }

    console.log(convertido)
}
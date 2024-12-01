var inicial = [["make", "ford"], ["model", "mustang"], ["year", 1964]]

function crearObjeto() {
    let objeto = {}
    for (const propiedad of inicial) {
        objeto[`${propiedad[0]}`]=propiedad[1]
    }
    console.log(objeto)
}
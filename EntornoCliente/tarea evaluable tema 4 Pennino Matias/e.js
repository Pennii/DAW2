let personajes = [{ nombre: "Tanjiro", anime: "Demon Slayer", edad: 16 },
{ nombre: "Naruto", anime: "Naruto", edad: 17 },
{ nombre: "Luffy", anime: "One Piece", edad: 35 },
]

function eliminarMedio() {
    let posicion
    //Calculamos si el array es par o impar y le asignamos el valor de la mitad
    if (personajes.length % 2 == 0) {
        posicion = personajes.length / 2
    } else {
        posicion = personajes.length / 2 + 1 - 0.5
    }
    delete personajes[posicion-1]

}

function mostrar() {
    let salida = "<ul>"
    for (const personaje of personajes) {
        if (personaje) {
            salida += "<li>"
            for (const atributo in personaje) {
                salida += `<strong>${atributo}</strong>: ` + personaje[atributo] + " "
            }
            salida += "</li>"
        }
    }
    salida += "</ul>"
    document.write(salida)
}

eliminarMedio()
mostrar()
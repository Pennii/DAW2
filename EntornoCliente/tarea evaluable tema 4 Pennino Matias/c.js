let personajes = [{ nombre: "Tanjiro", anime: "Demon Slayer", edad: 16 },
{ nombre: "Naruto", anime: "Naruto", edad: 17 },
{ nombre: "Luffy", anime: "One Piece", edad: 35 }
]

function eliminarPersonaje() {
    let nom = prompt("Ingresa el nombre de tu personaje")
    let ani = prompt("Ingresa el anime de tu personaje")
    let posicion
    //Una vez ingresados los datos se busca al personaje
    for (const personaje of personajes) {
        //Si el personaje existe se borra, sino no ocurre nada
        if (personaje.nombre == nom.trim() && personaje.anime == ani.trim()) {
            posicion = personajes.indexOf(personaje)
            delete personajes[posicion]
        }
    }

    mostrar()
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

eliminarPersonaje()
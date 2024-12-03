let personajes = [{ nombre: "Tanjiro", anime: "Demon Slayer", edad: 16 },
{ nombre: "Naruto", anime: "Naruto", edad: 17 },
{ nombre: "Luffy", anime: "One Piece", edad: 35 }
]

function ordenar(){
    //Ordenamos el array en funcion del nombre de cada personaje
    personajes.sort((a,b) => a.nombre.localeCompare(b.nombre))
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

ordenar()
mostrar()
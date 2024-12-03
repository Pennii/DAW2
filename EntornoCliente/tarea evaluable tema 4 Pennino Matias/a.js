let personajes = [{ nombre: "Tanjiro", anime: "Demon Slayer", edad: 16 },
{ nombre: "Naruto", anime: "Naruto", edad: 17 },
{ nombre: "Luffy", anime: "One Piece", edad: 35 }
]

//Funcion que utilizare en todos los ejercicios para imprimir los datos
function mostrar() {
    let salida = "<ul>"
    //Si un valor del array esta vacio no se imprime
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
mostrar()
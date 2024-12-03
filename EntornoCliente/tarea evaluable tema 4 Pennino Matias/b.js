let personajes = [{ nombre: "Tanjiro", anime: "Demon Slayer", edad: 16 },
{ nombre: "Naruto", anime: "Naruto", edad: 17 },
{ nombre: "Luffy", anime: "One Piece", edad: 35 }
]
function nuevoPersonaje() {
    let nombre = prompt("Ingresa el nombre de tu personaje")
    let anime = prompt("Ingresa el anime de tu personaje")
    let edad = parseInt(prompt("Ingresa la edad de tu personaje"))
    let nuevo
    while (isNaN(edad)) {
        alert("Estas ingresando una edad invalida, solo numeros por favor")
        edad = parseInt(prompt("Ingresa la edad de tu personaje"))
    }
    //Ingresamos y validamos los datos para agregarlos al array
    nuevo = { nombre: nombre, anime: anime, edad: edad }
    personajes.push(nuevo)

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

nuevoPersonaje()
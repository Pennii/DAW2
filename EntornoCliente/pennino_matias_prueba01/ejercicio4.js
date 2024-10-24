function caracteres(){
    var texto = prompt("Ingresa un texto de al menos 5 caracteres")
    var caracter
    var coincidencias = 0
    while(texto.trim().length < 5){//verificamos que el texto introducido cuente con al menos 5 caracteres sin contar espacios al inicio y final
        alert("CANTIDAD DE CARACTERES INVALIDA")
        texto = prompt("Ingresa un texto de al menos 5 caracteres")
    }
    caracter = prompt("Ingresa el caracter que quieres buscar")
    while(caracter.length > 1){//verificamos que solo se haya introducido un caracter
        alert("CANTIDAD DE CARACTERES INVALIDA")
        caracter = prompt("Ingresa el caracter que quieres buscar")
    }
    for (let i = 0; i < texto.length; i++) {//recorremos el texto y verificamos si coincide cada caracter con el introducido
        if (texto[i].toLowerCase() == caracter.toLowerCase()) {
            coincidencias++
        }
    }
    alert(`Encontramos ${coincidencias} coincidencias`)
}
const enviar = document.getElementById("enviar")
const nombre = document.getElementById("nombre")
const clave = document.getElementById("clave")
const repetida = document.getElementById("repetirClave")
const nacionalidad = document.getElementById("nacionalidad")
const salida = document.getElementById("salida")
const mostrarClave = document.getElementById("mostrarClave")

var colorNombre = nombre.style.backgroundColor
var colorClave = clave.style.backgroundColor
var colorRepetida = repetida.style.backgroundColor

function colorFoco(campo){
    campo.style.backgroundColor = "yellow"
}

nombre.addEventListener("focus", () => colorFoco(nombre))
clave.addEventListener("focus", () => colorFoco(clave))
repetida.addEventListener("focus", () => colorFoco(repetida))

nombre.addEventListener("focusout", () => nombre.style.backgroundColor = colorNombre)
clave.addEventListener("focusout", () => clave.style.backgroundColor = colorClave)
repetida.addEventListener("focusout", () => repetida.style.backgroundColor = colorRepetida)

mostrarClave.addEventListener("mousedown", () => {
    clave.type = "text"
    repetida.type = "text"
})

mostrarClave.addEventListener("mouseup", () => {
    clave.type = "password"
    repetida.type = "password"
})

enviar.addEventListener("click", (evento) => {
    let listaErrores = []
    let claveValida = false
    evento.preventDefault()
    if (!new RegExp(/^[A-Za-zÑñ]{10,25}$/).test(nombre.value)) {
        listaErrores.push("El nombre no puede estar vacio. Solo se admiten entre 10 y 25 caracteres alfabeticos")
        colorNombre = nombre.style.backgroundColor = "red"
    }else{
        colorNombre = nombre.style.backgroundColor = "green"
    }

    if (!new RegExp(/^[^ç$]\w{5,18}\d\.$/).test(clave.value) || !new RegExp(/\d{0,3}/).test(clave.value) || new RegExp(/(select)|(where)|;/).test(clave.value)) {
        listaErrores.push(`La contraseña no puede estar vacia. Solo se admiten entre 8 a 21 caracteres, debe tener hasta 3 numeros, no puede incluir 'select', 'where' o ';', 
            debe terminar en un numero y un punto (8. por ejemplo), y no puede iniciar con 'ç' o '$'`)
        colorClave = clave.style.backgroundColor = "red"
        colorRepetida = repetida.style.backgroundColor = "red"
    }else{
        colorClave = clave.style.backgroundColor = "green"
        claveValida = true
    }

    if (repetida.value != clave.value) {
        listaErrores.push("Las contraseñas no coinciden")
        colorClave = clave.style.backgroundColor = "red"
        colorRepetida = repetida.style.backgroundColor = "red"
    }else if(claveValida){
        colorClave = clave.style.backgroundColor = "green"
        colorRepetida = repetida.style.backgroundColor = "green"
    }

    if (listaErrores.length > 0) {
        salida.innerHTML = '<ul>'
        for (const error of listaErrores) {
            salida.innerHTML += `<li>${error}</li>`
        }
        salida.innerHTML += '</ul>'
    } else {
        if (nacionalidad.value != 0) {
            salida.innerHTML = `<p>El usuario ${nacionalidad.value} de nombre ${nombre.value} ha solicitado su admision en el congreso</p>`
        } else {
            salida.innerHTML = `<p>El usuario ${nombre.value} ha solicitado su admision en el congreso</p>`
        }
    }
})
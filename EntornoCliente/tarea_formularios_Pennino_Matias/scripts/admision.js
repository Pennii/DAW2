const enviar = document.getElementById("enviar")
const nombre = document.getElementById("nombre")
const clave = document.getElementById("clave")
const nacionalidad = document.getElementById("nacionalidad")
const salida = document.getElementById("salida")

var colorNombre = nombre.style.backgroundColor
var colorClave = clave.style.backgroundColor

function colorFoco(campo){
    campo.style.backgroundColor = "yellow"
}

nombre.addEventListener("focus", () => colorFoco(nombre))
clave.addEventListener("focus", () => colorFoco(clave))

nombre.addEventListener("focusout", () => nombre.style.backgroundColor = colorNombre)
clave.addEventListener("focusout", () => clave.style.backgroundColor = colorClave)

enviar.addEventListener("click", (evento) => {
    let listaErrores = []
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
    }else{
        colorClave = clave.style.backgroundColor = "green"
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
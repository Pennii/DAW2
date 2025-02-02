let conteoVisitas = localStorage.getItem("conteoVisitas") ? localStorage.getItem("conteoVisitas") : 0

const visitas = document.getElementById("visitas")
const formulario = document.getElementById("formulario")
const nombre = document.getElementById("nombre")
const codigo = document.getElementById("codigo")
const tipos = document.getElementsByName("tipo")
const pais = document.getElementById("listaPaises")

window.addEventListener("load", () => {
    localStorage.setItem("conteoVisitas", ++conteoVisitas)
    visitas.innerHTML = `<p>Esta es tu visita numero ${localStorage.getItem("conteoVisitas")}</p>`
})

formulario.addEventListener("submit", (evento) => {
    evento.preventDefault()
    let errores = []

    let tipoElegido = ""
    for (const tipo of tipos) {
        if (tipo.checked) {
         tipoElegido = tipo.value
        }
    }
    if (tipoElegido == "") {
        errores.push('Debes elegir un tipo de plan')
    }

    if (errores.length > 0) {
        salida.innerHTML = '<ul>'
        for (const error of errores) {
            salida.innerHTML += `<li>${error}</li>`
        }
        salida.innerHTML += '</ul>'
    } else {
        if (pais.value.trim() != "") {
            salida.innerHTML = `<p>El plan ${nombre.value} de tipo ${tipoElegido} se realizara en ${pais.value}</p>`
        } else {
            salida.innerHTML = `<p>El plan ${nombre.value} de tipo ${tipoElegido} ha sido aprobado</p>`
        }
    }
})

nombre.addEventListener("keyup", () => {
    nombre.value = nombre.value.toUpperCase()
})
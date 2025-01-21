const enviar = document.getElementById("enviar")
const salida = document.getElementById("salida")
const nombre = document.getElementById("nombre")
const apellido = document.getElementById("apellido")
const edad = document.getElementById("edad")
const matricula = document.getElementById("matricula")
const provincia = document.getElementById("provincia")
const formulario = document.getElementById("formulario")

enviar.addEventListener("click", (evento) => {
    let errores = []
    const provincias = ["Almeria", "Malaga", "Granada"]
    const textos = new RegExp(/^([A-Z][a-z]+[ ]?)+$/)
    if (!textos.test(nombre.value.trim())) {
        errores.push("El nombre no es valido")
    }
    if (!textos.test(apellido.value.trim())) {
        errores.push("El apellido no es valido")
    }
    let edades =new RegExp(/([1-9]{1})|([1-9][0-9]{1})/)
    console.log(edades.exec(edad.value))
    if (!new RegExp(/([1-9]{1})|([1-9][0-9]{1})/).exec(edad.value)) {
        errores.push("La edad no es valida")
        
    }
    if (!new RegExp(/^[0-9]{4} [A-Z]{3}$/).test(matricula.value)) {
        errores.push("La matricula no es valida")
    }
    if (!provincias.includes(provincia.value)) {
        errores.push("La provincia no es valida")
    }
    if (errores.length > 0) {
        evento.preventDefault()
        salida.innerHTML = ""
        errores.forEach(error => {
            salida.innerHTML += `<p>${error}</p>`
        });
    }
})
const conocer = document.getElementById("conocer")
const comentario = document.getElementById("comentario")
const caracteresConocer = document.getElementById("caracteresConocer")
const caracteresComentario = document.getElementById("caracteresComentario")
const enviar = document.getElementById("enviar")
const formulario = document.getElementById("formulario")
const cancelar = document.getElementById("cancelar")

const caracteresMax = 60
let comentarioValido = false
let conocerValido = false

conocer.addEventListener("keyup", () => {
    let actual = conocer.value.length
    conocerValido = actual < caracteresMax && actual > 0
    verificarAreas()
    caracteresConocer.innerText = `${actual}/${caracteresMax} caracteres`
})
comentario.addEventListener("keyup", () => {
    let actual = comentario.value.length
    comentarioValido = actual < caracteresMax && actual > 0
    verificarAreas()
    caracteresComentario.innerText = `${actual}/${caracteresMax} caracteres`
})

window.addEventListener("load", () => {
    verificarAreas()
    caracteresConocer.innerText = `0/${caracteresMax} caracteres`
    caracteresComentario.innerText = `0/${caracteresMax} caracteres`
})

formulario.addEventListener("submit", (envio) => {
    if (!comentarioValido || !conocerValido) {
        envio.preventDefault()
    }
})

cancelar.addEventListener("click", () => {
    comentarioValido = false
    conocerValido = false
    caracteresConocer.innerText = `0/${caracteresMax} caracteres`
    caracteresComentario.innerText = `0/${caracteresMax} caracteres`
    verificarAreas()
})

function verificarAreas() {
    if (comentarioValido && conocerValido) {
        enviar.style.display = ""
    } else {
        enviar.style.display = "none"
    }
}
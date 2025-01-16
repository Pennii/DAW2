import Parque from "./parque.js"
import Trabajador from "./trabajador.js"
import Visitante from "./visitante.js"

let visitante1 = new Visitante("Raul", 32)
let visitante2 = new Visitante("Julia", 21)
let trabajador1 = new Trabajador("Marcos", 22, 'Guia')
let parque1 = new Parque('Parque de la costa')

parque1.agregarPersona(visitante1)
parque1.agregarPersona(visitante2)
parque1.agregarPersona(trabajador1)
document.body.innerHTML += parque1.toString()
document.body.innerHTML += parque1.listarPersonas('Trabajador')
document.body.innerHTML += visitante2.toString()
document.body.innerHTML += visitante1.toString()
document.body.innerHTML += trabajador1.toString()
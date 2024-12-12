import Dios from "./Dios.js"
import Panteon from "./Panteon.js"
import SemiDios from "./SemiDios.js"
import Lucha from "./Lucha.js"

let ruta = './img/representacion.png'
let dios1 = new Dios('Zeus', ruta, 'bien', 100, 78)
let dios2 = new Dios('Ares', ruta, 'mal', 90, 68)
let dios3 = new Dios('Odin', ruta, 'mal', 98, 50)
let dios4 = new Dios('Thor', ruta, 'neutral', 90, 86)
let dios5 = new Dios('Anubis', ruta, 'neutral', 77, 77)
let dios6 = new Dios('Sussano', ruta, 'otro', 42, 98)
let dios7 = new Dios('Hades', ruta, 'bien', 88, 43)
let dios8 = new Dios('Buda', ruta, 'bien', 95, 95)
let dios9 = new Dios('Hermes', ruta, 'otro', 15, 100)
let dios10 = new Dios('Afrodita', ruta, 'mal', 35, 52)
let semidios1 = new SemiDios('Hercules', ruta, 'neutral', 90, 50, 'ninguno', false)
let panteon1 = new Panteon('olimpo', 'griego', -1000, 'antiguos dioses')
panteon1.addMiembro(dios1)
panteon1.addMiembro(dios2)
panteon1.addMiembro(semidios1)
panteon1.addMiembro(dios7)
console.log(panteon1)
console.log(panteon1.contarDioses())
console.log(panteon1.contarSemiDioses())
document.body.innerHTML = panteon1.toString()
semidios1.
console.log(Lucha.enfrentamiento(dios1, semidios1))
console.log(Lucha.enfrentamiento(dios6, dios5))
console.log(Lucha.enfrentamiento(dios3, dios10))
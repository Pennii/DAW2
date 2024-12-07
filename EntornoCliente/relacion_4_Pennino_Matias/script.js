import Ciudadano from "./ciudadano.js"
import Espia from "./espia.js"
import Agencia from "./agencia.js"

function buscarTopo(agencia1, agencia2, agente){
    return agencia1.agentes.includes(agente) && agencia2.agentes.includes(agente)
}

var contenedor = document.getElementById("contenedor")

try {
    var ciudadano1 = new Ciudadano('Santiago', 'USA', 19)
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var ciudadano2 = new Ciudadano('Santino', "URSS", 16)
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var ciudadano3 = new Ciudadano('Christian', 'REINO UNIDO', 21)
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var ciudadano4 = new Ciudadano('Lucas', 'URSS', 22)
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia1 = new Espia('Julian', 'RFA', 56, 'legal')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia2 = new Espia('Marcos', 'RFA', 27, 'legal')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia3 = new Espia('Rodrigo', 'RDA', 18, 'operativo')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia4 = new Espia('Dario', 'FRANCIA', 21, 'desestabilizador')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia5 = new Espia('Miguel', 'SUIZA', 42, 'legal')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia6 = new Espia('Julia', 'USA', 38, 'diplomatico')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia7 = new Espia('Laura', 'REINO UNIDO', 22, 'durmiente')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia8 = new Espia('Daniela', 'URSS', 24, 'provocador')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia9 = new Espia('Marta', 'USA', 21, 'infiltrado')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var espia10 = new Espia('Gabriela', 'RDA', 56, 'operativo')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var agencia1 = new Agencia("CIA", 'USA')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>`
}
try {
    var agencia2 = new Agencia("KGB", 'URSS')
} catch (error) {
    contenedor.innerHTML += `<p>Error: ${error}</p>` 
}

agencia1.reclutarAgente(espia1)
agencia1.reclutarAgente(espia2)
agencia1.reclutarAgente(espia3)
agencia2.reclutarAgente(espia3)
agencia2.reclutarAgente(espia4)
agencia2.reclutarAgente(espia5)

for (const espia of agencia1.agentes) {
    if (buscarTopo(agencia1, agencia2, espia)) {
        contenedor.innerHTML += `La ${agencia1.nombreAgencia} tiene un topo: ${espia.nombre}`
    }
}
contenedor.innerHTML+=agencia1.listadoAgentes("legal")
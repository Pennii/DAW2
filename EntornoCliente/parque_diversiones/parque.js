import Visitante from "./visitante.js"
import Trabajador from "./trabajador.js"

class Parque {
    #_nombreParque
    #_personas
    /**
     * 
     * @param {string} nombre 
     */
    constructor(nombre) {
        if (typeof nombre != 'string' || nombre.length < 5) {
            throw new Error("Nombre invalido")
        }
        this.#_nombreParque = nombre
        this.#_personas = []
    }

    agregarPersona(visitante) {
        if (!visitante instanceof Visitante) {
            throw new Error("Visitante invalido")
        }

        let existe = false
        let insertado = false

        for (const persona of this.#_personas) {
            if (persona.nombre === visitante.nombre) {
                existe = true
            }
        }
        if (!existe) {
            this.#_personas.push(visitante)
            insertado = true
        }

        return insertado
    }

    listarPersonas(tipo) {
        let tipos = ['Visitante', 'Trabajador']
        if (!tipos.includes(tipo)) {
            throw new Error("Tipo invalido")
        }
        let salida = '<ul>'
        if (tipo == 'Visitante') {
            for (const persona of this.#_personas) {
                if (persona instanceof Visitante) {
                    salida += `<li>${persona.toString()}</li>`
                }
            }
        } else {
            for (const persona of this.#_personas) {
                if (persona instanceof Trabajador) {
                    salida += `<li>${persona.toString()}</li>`
                }
            }
        }
        salida += '</ul>'
        return salida
    }
    toString() {
        let salida = '<ul>'
        for (const persona of this.#_personas) {
            salida += `<li>${persona.toString()}</li>`
        }
        salida += '</ul>'
        return salida
    }
}
export default Parque
import Dios from "./Dios.js"
import SemiDios from "./SemiDios.js"

class Panteon {
    #_nombre
    #_cultura
    #_periodo
    #_descripcion
    #_dioses

    constructor(nombre, cultura, periodo, descripcion) {
        if (descripcion.length < 10) {
            throw new Error("La descripcion es muy corta")
        }
        if (descripcion > 200) {
            descripcion = descripcion.substring(0,200)
        }
        this.#_nombre = nombre
        this.#_cultura = cultura
        this.#_descripcion = descripcion
        this.#_periodo = new Date(periodo, 1, 1)
        this.#_dioses = []    
    }

    get nombre(){
        return this.#_nombre
    }

    get cultura(){
        return this.#_cultura
    }

    get descripcion(){
        return this.#_descripcion
    }

    get periodo(){
        return this.#_periodo
    }

    get dioses(){
        return this.#_dioses
    }

    set nombre(nuevo){
        this.#_nombre = nuevo
    }

    set cultura(nuevo){
        this.#_cultura = nuevo
    }

    set descripcion(nuevo){
        if (nuevo.length < 10) {
            throw new Error("La descripcion es muy corta")
        }
        if (nuevo > 200) {
            nuevo = nuevo.substring(0,200)
        }
        this.#_descripcion = nuevo
    }

    set periodo(nuevo){
        this.#_periodo = nuevo
    }

    addMiembro(miembro){
        let encontrado = false
        if (miembro instanceof Dios || miembro instanceof SemiDios) {
            for (const dios of this.dioses) {
                if (dios.nombre === miembro.nombre) {
                    encontrado = true
                }
            }
            if (!encontrado) {
                this.#_dioses.push(miembro)
            }
        }
    }

    eliminarSemidioses(){
        let posicion
        for (const dios of this.dioses) {
            if (dios instanceof SemiDios) {
                    posicion = this.#_dioses.indexOf(dios)
                    this.#_dioses.splice(posicion,posicion+1)
            }
        }
    }

    contarDioses(){
        let contador = 0
        for (const dios of this.dioses) {
            if (!(dios instanceof SemiDios)) {
                contador++
            }
        }
        return contador
    }

    contarSemiDioses(){
        let contador = 0
        for (const dios of this.dioses) {
            if (dios instanceof SemiDios) {
                contador++
            }
        }
        return contador
    }

    toString(){
        let salida = ''
        for (const dios of this.dioses) {
            salida += `<h1>${dios.nombre}</h1>`
            salida += dios.toString()
        }
        return salida
    }

}
export default Panteon
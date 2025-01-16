import Visitante from "./visitante.js";

/**
 * @extends Visitante
 */
class Trabajador extends Visitante {
    #_puesto
    static _opciones = ['Cajero','Mecanico','Guia']
    /**
     * 
     * @param {string} nombre 
     * @param {number} edad 
     * @param {string} puesto 
     */
    constructor(nombre, edad, puesto) {
        if (!Trabajador._opciones.includes(puesto)) {
            throw new Error("Puesto invalido")
        }
        super(nombre, edad)
        this.#_puesto = puesto
    }
    get puesto(){
        return this.#_puesto
    }
    set puesto(puesto){
        if (!Trabajador._opciones.includes(puesto)) {
            throw new Error("Puesto invalido")
        }
        this.#_puesto = puesto
    }

    toString(){
        return super.toString()+`, Puesto: ${this.puesto}`
    }
}
export default Trabajador
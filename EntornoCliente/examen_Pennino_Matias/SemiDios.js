import Dios from './Dios.js'
/**
 * @extends Dios
 */
class SemiDios extends Dios {

    #_puntoDebil
    #_inmortal

    constructor(nombre, imagen, bando, poder, vida, debil, inmortal) {
        if (!Number.isInteger(vida) || vida < 0 || vida > 50) {
            throw new Error("Vida invalida, debe ser entero del 0 a 50")
        }
        if (typeof (inmortal) != 'boolean') {
            throw new Error("El valor inmortal debe ser true o false")
        }
        super(nombre, imagen, bando, poder, vida)
        this.#_puntoDebil = debil
        this.#_inmortal = inmortal
    }

    get puntoDebil(){
        return this.#_puntoDebil
    }

    get inmortal(){
        return this.#_inmortal
    }

    set inmortal(inmortal){
        if (typeof (inmortal) != 'boolean') {
            throw new Error("El valor inmortal debe ser true o false")
        }
        this.#_inmortal = inmortal
    }

    set puntoDebil(nuevo){
        this.#_puntoDebil = nuevo
    }

    toString(){
        let salida = '<ul>'
        salida += `<li>nombre: ${this.nombre}</li>`
        salida += `<li>representacion: <img src='${this.representacion}' alt='representacion'></li>`
        salida += `<li>bando: ${this.bando}</li>`
        salida += `<li>poder: ${this.poder}</li>`
        salida += `<li>vida: ${this.vida}</li>`
        salida += `<li>punto debil: ${this.puntoDebil}</li>`
        salida += `<li>inmortal: ${this.inmortal?'Si':'No'}</li>`
        salida += "</ul>"
        return salida
    }
}
export default SemiDios
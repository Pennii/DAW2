class Visitante {
    #_nombre
    #_edad
    /**
     * 
     * @param {string} nombre 
     * @param {number} edad 
     */
    constructor(nombre, edad) {
        if (typeof (nombre) != 'string' || nombre.length < 3) {
            throw new Error("El nombre es invalido")
        }
        if (!Number.isInteger(edad) || edad < 1) {
            throw new Error("Edad invalida")
        }
        this.#_edad = edad
        this.#_nombre = nombre
    }
    get nombre(){
        return this.#_nombre
    }
    get edad(){
        return this.#_edad
    }
    set nombre(nombre){
        if (typeof (nombre) != 'string' || nombre.length < 3) {
            throw new Error("El nombre es invalido")
        }
        this.#_nombre = nombre
    }
    set edad(edad){
        if (!Number.isInteger(edad) || edad < 1) {
            throw new Error("Edad invalida")
        }
        this.#_edad = edad 
    }
    toString(){
        return `Nombre: ${this.nombre}, Edad: ${this.edad}`
    }
}
export default Visitante
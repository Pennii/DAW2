class Ciudadano {
    #_nombre
    #_pais
    #_edad
    static #_paises = ["USA", "URSS", "REINO UNIDO", "RDA", "RFA", "FRANCIA", "SUIZA"]
    constructor(nombre, pais, edad) {
        if (typeof (nombre) != "string" || nombre.length < 5) {
            throw new Error("Nombre invalido")
        }
        if (!Ciudadano.paises.includes(pais)) {
            throw new Error("Pais invalido")
        }
        if (!Number.isInteger(edad) || edad <= 1 || edad >= 125) {
            throw new Error("Edad invalida")
        }

        this.#_nombre = nombre
        this.#_pais = pais
        this.#_edad = edad
    }

    get nombre() {
        return this.#_nombre
    }

    set nombre(nuevo) {
        if (typeof (nuevo) != "string" || nuevo.length < 5) {
            throw new Error("Nombre invalido")
        }
        this.#_nombre = nuevo
    }
    get pais() {
        return this.#_pais
    }

    set pais(nuevo) {
        if (!Ciudadano.paises.includes(nuevo)) {
            throw new Error("Pais invalido")
        }
        this.#_pais = nuevo
    }
    get edad() {
        return this.#_edad
    }

    set edad(nuevo) {
        if (!Number.isInteger(nuevo) || nuevo <= 1 || nuevo >= 125) {
            throw new Error("Edad invalida")
        }
        this.#_edad = nuevo
    }

    static get paises(){
        return Ciudadano.#_paises
    }

    toString() {
        return `El ciudadano ${this.nombre} es un ciudadano de ${this.pais} que tiene ${this.edad}`
    }
}

export default Ciudadano
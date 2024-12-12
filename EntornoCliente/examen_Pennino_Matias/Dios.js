class Dios {
    #_nombre
    #_representacion
    #_bando
    #_poder
    #_vida
    static #_bandos = ['bien', 'mal', 'neutral', 'otro']


    constructor(nombre, imagen, bando, poder, vida) {
        if (nombre === '') {
            throw new Error("El nombre no puede estar vacio")
        }
        if (!Dios.#_bandos.includes(bando)) {
            throw new Error("Bando invalido")
        }
        if (!Number.isInteger(poder) || poder < 0 || poder > 100) {
            throw new Error("Poder invalido, debe ser entero del 0 a 100")
        }
        if (!Number.isInteger(vida) || vida < 0 || vida > 100) {
            throw new Error("Vida invalida, debe ser entero del 0 a 100")
        }
        this.#_nombre = nombre
        this.#_bando = bando
        this.#_poder = poder
        this.#_representacion = imagen
        this.#_vida = vida
    }

    get nombre() {
        return this.#_nombre
    }
    get representacion() {
        return this.#_representacion
    }
    get poder() {
        return this.#_poder
    }
    get vida() {
        return this.#_vida
    }
    get bando() {
        return this.#_bando
    }

    set nombre(nombre) {
        if (nombre === '') {
            throw new Error("El nombre no puede estar vacio")
        }
        this.#_nombre = nombre
    }

    set representacion(nuevo) {
        this.#_representacion = nuevo
    }

    set poder(poder) {
        if (!Number.isInteger(poder) || poder < 0 || poder > 100) {
            throw new Error("Poder invalido, debe ser entero del 0 a 100")
        }
        this.#_poder = poder
    }

    set bando(bando) {
        if (!Dios.#_bandos.includes(bando)) {
            throw new Error("Bando invalido")
        }
        this.#_bando = bando
    }

    set vida(vida) {
        if (!Number.isInteger(vida) || vida < 0 || vida > 100) {
            throw new Error("Vida invalida, debe ser entero del 0 a 100")
        }
        this.#_vida = vida
    }

    /**
     * Funcion que permite restar vida en los enfrentamientos
     * @param {Number} damage 
     */
    restarVida(damage){
        if (this.vida - damage < 0) {
            this.vida = 0
        }else{
        this.vida -= damage 
        }
    }

    toString() {
        let salida = '<table><tr>'
        salida += `<th>Nombre</th>`
        salida += `<th>Imagen</th>`
        salida += `<th>Bando</th>`
        salida += `<th>Poder</th>`
        salida += `<th>Vida</th>`
        salida += "</tr>"
        salida += "<tr>"
        salida += `<td>${this.nombre}</td>`
        salida += `<td><img src='${this.#_representacion}' alt='representacion'></td>`
        salida += `<td>${this.bando}</td>`
        salida += `<td>${this.poder}</td>`
        salida += `<td>${this.vida}</td>`
        salida += "</tr>"
        salida += "</table>"
        return salida
    }
}
export default Dios
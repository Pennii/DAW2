import Ciudadano from "/ciudadano.js";


export default class Espia extends Ciudadano {
    #_tipo
    static #_tipos = ['desestabilizador', 'diplomatico', 'infiltrado', 'legal', 'operativo', 'provocador', 'durmiente']
    constructor(nombre, pais, edad, tipo) {
        if (!Ciudadano.paises.includes(pais)) {
            pais = "SUIZA"
        }
        if (edad < 16) {
            throw new Error("Edad invalida");
            
        }
        if (!Espia.tipos.includes(tipo)) {
            throw new Error("Tipo invalido")
        }
        super(nombre, pais, edad)
        this.#_tipo = tipo
    }
    get tipo(){
        return this.#_tipo
    }
    set tipo(nuevo){
        if (!Espia.#_tipos.includes(nuevo)) {
            throw new Error("Tipo invalido")
        }
        this.#_tipo=nuevo
    }

    static get tipos(){
        return Espia.#_tipos
    }

    toString(){
        return super.toString()+` y es un agente ${this.tipo}`
    }
}

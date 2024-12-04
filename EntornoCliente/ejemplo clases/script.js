class SerVivo {
    //# para atributos privados, _ para poder nombrar al get y al set como el atributo
    static #contador = 0
    #_peso
    constructor(peso) {
        this.#_peso = peso
        SerVivo.#contador++
    }

    toString() {
        return ("este ser vivo pesa: "+this.#_peso)
    }
    static conteo(){
        return SerVivo.#contador
    }
    get peso(){
        return this.#_peso
    }
    set peso(nuevo){
        this.#_peso = nuevo
    }
}

class Perro extends SerVivo{
    #_edad
    constructor(peso, edad){
        super(peso)
        this.#_edad = edad
    }

    toString(){
        return super.toString()+" y tiene "+this.#_edad+" años"
    }
}

let gato = new SerVivo(5)
let perro = new Perro(25, 6)

console.log(perro.toString())
console.log(SerVivo.conteo())
gato.peso = 12
console.log(gato.peso)
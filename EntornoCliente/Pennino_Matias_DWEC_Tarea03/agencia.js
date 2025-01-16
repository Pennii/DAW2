import Espia from "./espia.js"
import Ciudadano from "./ciudadano.js"
class Agencia {
    #_nombreAgencia
    #_pais
    #_agentes
    static #_paises = ["USA", "REINO UNIDO", "URSS"]
    constructor(nombre, pais) {
        if (typeof (nombre) != "string") {
            throw new Error("Nombre invalido");
        }
        if (!Agencia.paises.includes(pais)) {
            throw new Error("Pais invalido");
        }
        this.#_nombreAgencia = nombre
        this.#_pais = pais
        this.#_agentes = []
    }
    static get paises() {
        return Agencia.#_paises
    }
    get agentes() {
        return this.#_agentes
    }
    get nombreAgencia(){
        return this.#_nombreAgencia
    }
    get pais(){
        return this.#_pais
    }
    set pais(nuevo){
        if (!Agencia.paises.includes(nuevo)) {
            throw new Error("Pais invalido");
        }
        this.#_pais = nuevo
    }
    set nombreAgencia(nuevo){
        if (typeof (nombre) != "string") {
            throw new Error("Nombre invalido");
        }
        this.#_nombreAgencia = nuevo
    }
    reclutarAgente(espia) {
        let introducido
        if (espia instanceof Espia) {
            if (!this.agentes.includes(espia)) {
                this.#_agentes.push(espia)
                introducido = this.agentes.includes(espia)
            }else{
                introducido = false
            }
        } else {
            introducido = false
        }

        return introducido
    }
    cesarAgente(nombre) {
        let posicion
        let borrado = false
        for (const espia of this.agentes) {
            if (espia instanceof Espia) {
                if (espia.nombre === nombre) {
                    posicion = this.#_agentes.indexOf(espia)
                    this.#_agentes.splice(posicion,posicion+1)
                    borrado = true
                }
            }
        }
        return borrado
    }

    listadoAgentes(tipo){
        let salida = ''
        for (const espia of this.agentes) {
            if (espia.tipo === tipo) {
                salida+=`-${espia.toString()} `
            }
        }
        if (salida === '') {
            salida = `No hay espias de tipo ${tipo} en esta agencia`
        }
        return salida
    }

    listadoOrdenado(ordenador){
        let aux = this.agentes
        let salida = ""
        if (ordenador === "nombre") {
            aux.sort((a,b) => a.nombre.localeCompare(b.nombre))
        }else if(ordenador === "edad"){
            aux.sort((a,b) => a.edad - b.edad)
        }else{
            salida = false
        }

        if (salida !== false) {
            for (const espia of aux) {
                salida += "-"+espia.toString()+"\n"
            }
        }
        return salida
    }

    #_formateaInfo(){
        let lista = this.agentes
        lista.sort((a,b)=>a.pais.localeCompare(b.pais))
        let salida = '<table border="1"><tr>'
            salida += `<th>Nombre</th>`
            salida += `<th>edad</th>`
            salida += `<th>pais</th>`
            salida += `<th>tipo</th>`
            salida += "</tr>"
        for (const espia of lista) {
            salida += "<tr>"
            salida += `<td>${espia.nombre}</td>`
            salida += `<td>${espia.edad}</td>`
            salida += `<td>${espia.pais}</td>`
            salida += `<td>${espia.tipo}</td>`
            salida+="</tr>"
        }
        salida += "</table>"
        return salida
    }

    toString(){
        return this.#_formateaInfo()
    }
}
export default Agencia
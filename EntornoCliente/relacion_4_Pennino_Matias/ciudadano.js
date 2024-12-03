class Ciudadano {
    #nombre
    #pais
    #edad
 static paises = ["USA", "URSS", "REINO UNIDO", "RDA", "RFA", "FRANCIA", "SUIZA"]
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

        this.#nombre = nombre
        this.#pais = pais
        this.#edad = edad
    }
}
export default Ciudadano
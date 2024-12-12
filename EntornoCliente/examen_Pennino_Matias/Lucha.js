import Dios from "./Dios.js"
import SemiDios from "./SemiDios.js"

class Lucha{
    static enfrentamiento(dios1, dios2) {
        let damage1, damage2
        let ganador
        let turnos = 1
        let turno
        if ((dios1 instanceof Dios || dios1 instanceof SemiDios) && (dios2 instanceof Dios || dios2 instanceof SemiDios)) {
            while (dios1.vida > 0 && dios2.vida > 0) {
                damage1 = parseInt(dios1.poder*Math.random())
                dios2.restarVida(damage1)
                damage2 = parseInt(dios2.poder*Math.random())
                dios1.restarVida(damage2)
                turno = `En el turno ${turnos}: `
                if (dios1.vida > 0) {
                    turno += `${dios1.nombre} ha recibido ${damage2} puntos de daño y tiene ${dios1.vida} puntos de vida restantes. `
                }else{
                    turno += `a ${dios1.nombre} ha recibido ${damage2} puntos de daño y no le quedan puntos de vida, ha muerto. `
                }
                if (dios2.vida > 0 ) {
                    turno += `${dios2.nombre} ha recibido ${damage1} puntos de daño y tiene ${dios2.vida} puntos de vida restantes.`
                }else{
                    turno += `a ${dios2.nombre} ha recibido ${damage1} puntos de daño y no le quedan puntos de vida, ha muerto.`
                }
                console.log(turno)
                turnos++
            }
            if (dios1.vida > 0) {
                ganador = `El ganador fue ${dios1.nombre}`
            }else if (dios2.vida > 0) {
                ganador = `El ganador fue ${dios2.nombre}`
            }else{
                ganador = 'El resultado ha sido un empate'
            }
        }
        return ganador
    }
}
export default Lucha
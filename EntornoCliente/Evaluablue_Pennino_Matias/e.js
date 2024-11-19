var inicial = [["make", "ford"], ["model", "mustang"], ["year", 1964]]

function reemplazarMedio() {
    var mitad
    if (inicial.length % 2 == 0) {
        mitad = inicial.length / 2
    }else{
        mitad = parseInt(inicial.length / 2) + 1
    }
}
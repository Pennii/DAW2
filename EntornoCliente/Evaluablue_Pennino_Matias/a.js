var inicial = [["make", "ford"], ["model", "mustang"], ["year", 1964]]

function crearObjeto() {
    var objeto = [{make:inicial[0][1], model:inicial[1][1], year: inicial[2][1]}]
    
    document.body.innerHTML = `<ul><li>make:${objeto[0].make}</li><li>${objeto[0].model}</li><li>year:${objeto[0].year}</li></ul>`
}
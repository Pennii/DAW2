var inicial = [["make","ford"], ["model", "mustang"], ["year", 1964]]

function eliminarPrincipio(){
    document.body.innerHTML = `<p>Tenemos el array ${inicial.toString()}</p>`
    inicial.reverse()
    var eliminado = inicial.pop()
    inicial.reverse()
    document.body.innerHTML+=`<p>Se ha eliminado el elemento ${eliminado}</p>`
}
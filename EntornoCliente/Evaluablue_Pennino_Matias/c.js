var inicial = [["make","ford"], ["model", "mustang"], ["year", 1964]]

function agregarPrincipio(){
    document.body.innerHTML = `<p>Tenemos el array ${inicial.toString()}</p>`
    var elemento = prompt("Ingresa el elemento que quieras agregar")
    var clave = prompt("Ingresa la clave del elemento")
    var agregar = [clave, elemento]
    inicial.reverse();
    inicial.push(agregar)
    inicial.reverse()
    document.body.innerHTML+=`<p>Se ha agregado el elemento [${clave},${elemento}]</p>`
}
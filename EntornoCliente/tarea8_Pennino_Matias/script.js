var lista = ["papa", "manzana", "banana", "naranja"]

function cantidadElementos() {
    var elementos = lista.length
    alert(`el array tiene ${elementos} elementos`)
}

function mostrar() {
    var listaElem = ""
    lista.forEach(elemento => {
        listaElem = listaElem + " -" + elemento
    });
    alert(`Lista de elementos: ${listaElem}`)
}

function mostrarInverso() {
    var inverso = lista.reverse()
    var listaElem = ""
    inverso.forEach(elemento => {
        listaElem = listaElem + " -" + elemento
    });
    alert(`Lista de elementos al reves es: ${listaElem}`)
}

function alfabetico(){
    var segunda = []
    lista.forEach(elemento => {
       segunda.push(elemento)
    });
    alert(segunda.sort().toString())
}

function principio() {
    lista = lista.reverse()
    lista.push(prompt("Ingresa el elemento"))
    lista = lista.reverse()
}

function final() {
    lista.push(prompt("Ingresa el elemento"))
}

function borrarPrimero() {
    var elemento
    lista.reverse()
    elemento = lista.length > 0 ? lista.pop() : "No hay mas elementos"
    alert(`Se ha eleminado: ${elemento}`)
    lista.reverse()
}

function borrarUltimo() {
    var elemento = lista.length > 0 ? lista.pop() : "No hay mas elementos"
    alert(`Se ha eleminado: ${elemento}`)
}

function mostrarPosicion(){
    var salida
    var posicion = prompt("Ingresa la posicion considerando que la primera posicion es 1")
    if (!isNaN(posicion) && posicion >= 0 && posicion <= lista.length) {
        salida = `El elemento en la posicion ${posicion} es: ${lista[posicion-1]}`
    }else{
        salida = "Posicion invalida"
    }
    alert(salida)
}

function mostrarElemento(){
    var salida
    var elemento = prompt("Ingresa el elemento a buscar")
    if (lista.includes(elemento)) {
        salida = `El elemento se encuentra en la posicion ${lista.indexOf(elemento)+1}`
    }else{
        salida = "El elemento no esta en la lista"
    }
    alert(salida)
}

function intervalo(){
    alert(`Rango del intervalo [0-${lista.length}]`)
    var inicio = parseInt(prompt("Ingresa el inicio del intervalo"))
    var fin = parseInt(prompt("Ingresa el fin del intervalo"))
    var salida, segunda
    if (!isNaN(inicio) && !isNaN(fin) && inicio >=0 && fin > inicio && lista.length >= fin) {
        segunda = lista.slice(inicio,fin)
        salida = `la lista de elementos en el intervalo es: ${segunda.toString()}`
    }else{
        salida = "Datos de intervalo incorrectos"
    }
    alert(salida)
}
var inventario = [{ "nombre": "caja", "cantidad": 40, "precio": 5 },
{ "nombre": "lapiz", "cantidad": 100, "precio": 1 },
{ "nombre": "goma", "cantidad": 100, "precio": 2 }
]

function agregarProducto() {
    var nombre = prompt("Ingresa el nombre del producto")
    var cantidad = parseInt(prompt("Ingresa la cantidad del producto"))
    var precio = parseFloat(prompt("Ingresa el precio del producto"))

    while (isNaN(cantidad) || cantidad < 0) {
        alert("Error al ingresar cantidad, hagalo otra vez")
        cantidad = parseInt(prompt("Ingresa la cantidad del producto"))
    }
    while (isNaN(precio) || precio <= 0) {
        alert("Error al ingresar precio, hagalo otra vez")
        precio = parseFloat(prompt("Ingresa el precio del producto"))
    }

    inventario.push({ "nombre": nombre, "cantidad": cantidad, "precio": precio })
}

function mostrarInventario() {
    console.log("Se mostraran los productos:")
    inventario.forEach(producto => {
        console.log("nombre: " + producto["nombre"] + " cantidad: " + producto["cantidad"] + " precio: " + producto["precio"])
    })
}

function totalInventario() {
    var total = 0
    inventario.forEach(producto => {
        total += producto["cantidad"] * producto["precio"]
    })
    console.log("El valor total del inventario es: " + total)
}

var estudiantes = [{ nombre: "Pepe", edad: 17, calificacion: 80 }, { nombre: "Julian", edad: 16, calificacion: 20 }, { nombre: "Raul", edad: 17, calificacion: 100 }]

function agregarEstudiante() {
    var nombreValido = new RegExp(/([A-ZÑ][a-zñ]+)([ ][A-ZÑ][a-zñ]+)*/)
    var nom = prompt("Ingresa un nombre para el estudiante")
    var edadEstudiante = parseInt(prompt("Ingresa la edad"))
    var cali = parseFloat(prompt("Ingresa la calificacion"))
    var estudiante

    while (!nombreValido.test(nom)) {
        alert("Error al introducir el nombre")
        nom = prompt("Ingresa un nombre para el estudiante")
    }

    while (isNaN(edadEstudiante)) {
        alert("Error al introducir la edad")
        edadEstudiante = prompt("Ingresa la edad del estudiante")
    }
    while (isNaN(cali)) {
        alert("Error al introducir la calificacion")
        cali = prompt("Ingresa la calificacion del estudiante")
    }
    estudiante = { nombre: nom, edad: edadEstudiante, calificacion: cali }
    estudiantes.push(estudiante)
}

function mostrarEstudiantes() {
    console.log("Se mostraran los estudiantes:")
    estudiantes.forEach(estudiante => {
        console.log("nombre: " + estudiante.nombre + " edad: " + estudiante.edad + " calificacion: " + estudiante.calificacion)
    })
}

function promedioCalificaciones() {
    var total = 0
    var promedio
    estudiantes.forEach(estudiante => {
        total += estudiante.calificacion
    })
    if (estudiantes.length > 0) {
        promedio = total / estudiantes.length
    } else {
        promedio = "No hay estudiantes para promediar"
    }
    console.log(`El promedio de calificaciones es: ${promedio}`)
}

var biblioteca = [{ titulo: "Fantasia", autor: "Gustavo", anioPublicacion: 1998 }, { titulo: "La edad dorada", autor: "Gustavo", anioPublicacion: 1995 }, { titulo: "2012", autor: "Gabriel", anioPublicacion: 2012 }]

function buscarLibroPorTitulo(titulo) {
    return biblioteca.find(libro => libro.titulo === titulo)
}

function existeLibro(titulo) {
    return biblioteca.some(libro => libro.titulo === titulo)
}

function indiceDelLibro(titulo){
    return biblioteca.findIndex(libro => libro.titulo === titulo)
}

function librosPorAutor(autor){
    return biblioteca.filter(libro => libro.autor === autor)
}

function ordenarPorAnio(){
    biblioteca.sort(function (a, b){
        return a.anioPublicacion - b.anioPublicacion
    })
    console.log("Libros ordenados")
}

//Estas dos funciones son para trabajar en el html
function trabajarConLibro(){
    var libro
    var titulo = prompt("Ingresa el titulo del libro con el que quieras trabajar")
    if (existeLibro(titulo)) {
        libro = buscarLibroPorTitulo(titulo)
        console.log(`Datos del libro:\ntitulo: ${libro.titulo}\naño de publicacion: ${libro.anioPublicacion}\nautor: ${libro.autor}`)
        console.log(`El libro esta en la posicion ${indiceDelLibro(titulo)} de la biblioteca`)
        
    }else{
        console.log("Libro no encontrado")
    }
}

function mostrarLibrosPorAutor(){
    var autor = prompt("Ingresa un autor")
    var libros
    if (biblioteca.some(libro => libro.autor === autor)) {
        libros = librosPorAutor(autor)
        console.log("Datos de los libros: ")
        libros.forEach(libro => {
            console.log(`titulo: ${libro.titulo}\naño de publicacion: ${libro.anioPublicacion}\nautor: ${libro.autor}`)
        });
    }else{
        console.log("Autor no encontrado")
    }
}
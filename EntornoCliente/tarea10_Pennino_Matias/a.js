var estudiantes = [{ nombre: "Juan", calificaciones: [{ nombre: "matematica", nota: 85 }, { nombre: "historia", nota: 90 }, { nombre: "ciencias", nota: 78 }] },
{ nombre: "Maria", calificaciones: [{ nombre: "matematica", nota: 92 }, { nombre: "historia", nota: 88 }, { nombre: "ciencias", nota: 95 }] },
{ nombre: "Pedro", calificaciones: [{ nombre: "matematica", nota: 76 }, { nombre: "historia", nota: 85 }, { nombre: "ciencias", nota: 80 }] }]


function mostrar() {
    var salida = "<h1>Lista de estudiantes y calificaciones</h1>"
    estudiantes.forEach(estudiante => {
        salida += `<h2> ${estudiante.nombre}</h2>
        <ul>`
        estudiante.calificaciones.forEach(asignatura => {
            salida += `<li>${asignatura.nombre}: ${asignatura.nota}</li>`
        })
        salida += `</ul > `
    })
    document.body.innerHTML = salida
}
var ventas = [{ trimestre: "trimestre 1", total: { primero: "1500€", segundo: "2300€", tercero: "1700€" } },
{ trimestre: "trimestre 2", total: { primero: "2100€", segundo: "1900€", tercero: "2400€" } },
{ trimestre: "trimestre 3", total: { primero: "3000€", segundo: "2700€", tercero: "2900€" } },
{ trimestre: "trimestre 4", total: { primero: "3200€", segundo: "3100€", tercero: "3300€" } }
]

function mostrar() {
    salida = `<h1>Ventas por trimestre</h1>
    <table border="1" style="border-collapse:collapse; text-align:center">
    <tr>
    <th>Trimestre</th><th>Enero-Marzo</th><th>Abril-Junio</th><th>Julio-Septiembre</th><th>Octubre-Diciembre</th>
    </tr>`
    ventas.forEach( venta => {
        salida += `<tr>
        <td>${venta.trimestre}</td><td>${venta.total.primero}</td><td>${venta.total.segundo}</td><td>${venta.total.tercero}</td>
        </tr>`
    })
    salida += `</table>`
    document.body.innerHTML = salida
}
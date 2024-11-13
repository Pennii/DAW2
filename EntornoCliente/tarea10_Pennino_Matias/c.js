var productos = [{ nombre: "Laptop", categoria: "Electronica", precio: "1200$" },
{ nombre: "Telefono", categoria: "Electronica", precio: "800$" },
{ nombre: "Camiseta", categoria: "Ropa", precio: "20$" },
{ nombre: "Zapatos", categoria: "Ropa", precio: "50$" },
{ nombre: "Sofa", categoria: "Muebles", precio: "450$" }
]

function mostrar() {
    var salida = ""
    productos.forEach(producto => {
        salida += `<div><p><strong>Nombre</strong>: ${producto.nombre}</p>
      <p><strong>Categoria</strong>: ${producto.categoria}</p>
      <p><strong>Precio</strong>: ${producto.precio}</p>
      </div>`
    })
    document.body.innerHTML = salida
}
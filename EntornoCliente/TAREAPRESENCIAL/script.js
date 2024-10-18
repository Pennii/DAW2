var creada = false
var nueva;
function abrir() {
    if (!creada) {
        nueva = window.open("http://www.google.es", "", "height=800px,width=600px");
        creada = ture;
    }else{
        alert("YA SE HA CREADO LA VENTANA");
    }

}
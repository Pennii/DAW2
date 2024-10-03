var nombre = prompt("Ingresa un nombre");
var usuario;
if(nombre.endsWith("o") || nombre.endsWith("a")){
    if(nombre.endsWith("o")){
        usuario = "masculino";
    }else{
        usuario = "femenino";
    }
    document.write("hola usuario "+usuario)
}else{
    document.write("usuario no reconocido")
}
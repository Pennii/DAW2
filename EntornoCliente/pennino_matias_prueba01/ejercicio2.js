function fechas(){
    var anio = parseInt(Math.random()*200 + 1900)//generamos un numero aleatorio en el rango [1900-2100]
    var mes = parseInt(Math.random()*11)//generamos un numero aleatorio en el rango [0-11]
    var dia = parseInt(Math.random() * 30 + 1)//generamos un numero aleatorio en el rango [1-31]
    if (mes == 1) {
        while(dia > 29){//si el mes es febrero y el dia es mayor a 29 se genera otro numero
        dia = parseInt(Math.random() * 30 + 1)
        }
    }
    alert(`tu fecha es: ${dia}/${mes+1}/${anio}`)//se muestra la fecha en el formato dia/mes/año sumandole 1 al mes para tener un resultado mas legible
}
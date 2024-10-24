function ejecutar() {
  // Realicemos un programa que lee un número, lo muestra en pantalla, y hace un bucle con el mismo de 1  a 50.
  let variable1,
    variable2 = 3; //declaro variables.
  //nombre=alert(“dime tu nombre”) ;
  variable2 = prompt("dime tu numero"); //deberiamos usar un prompt y no un alert, ademas debemos pedir un numero. Lo almacenamos en la variable2 para no crear mas variables
  document.write(`tu numero es: ${variable2}</br>`)
  //variable1=Math.Random(1)*50; // Genero un número al azar entre 0 y 1 y lo multiplico por 50.
  variable1 = parseInt(Math.random()*50 + 1); //no hace falta poner el 1 como parametro, y debe devolver un entero para evitar problemas en el bucle. Incluimos el 1 en el rango para poder cumplir con el enunciado
  document.write(`tu numero aleatorio es: ${variable1}</br>`)//mostramos el numero aleatorio
  //while (true) { // voy a mostrar el nombre
  var i = variable1;//igualamos la variable i a la variable1
  while (i != 0) {
    //es mas conveniente establecer que si la variable i es distinta a 0 el bucle continuara
    //let i; // contador que se va a reducir desde la variable1 que ha generado un número entre 0 y 50
    //como declaramos i antes en el codigo no hace falta declararla otra vez
    //if (i=0) {
    /*if (i == 0) {
      break;
    } else{
        document.write(variable1);  
    } */
   //el formato del bucle nos permite no utiliar el if
   document.write(`${variable2} \n`)
    i--;
  }
}

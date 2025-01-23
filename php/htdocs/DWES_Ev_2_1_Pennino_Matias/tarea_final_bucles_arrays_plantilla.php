<<html>
    <head>
        <title>tarea evaluable</title>
    </head>
    <body>
        <?php
        $variableTipo1 = 1;
        $variableTipo2 = "true";
        $variableTipo3 = false;
        $arrayTipos = ["sopa", "9", true, "true", false, 0.25, "1.5", 9, "lunes"];
        $arrayBiDimensional = ["lunes" => [7, 14, 21, 28], "martes" => [1, 8, 15, 22, 29], "miercoles" => [2, 9, 16, 23, 30], "jueves" => [3, 10, 17, 24, 31], "viernes" => [4, 11, 18, 25], "sábado" => [5, 12, 19, 26], "domingo" => [6, 13, 20, 27]];

//Ejercicio 1. Comprobar si las variables contienen realmente valores booleanos
// 1.a) Sin utilizar las funciones propias de php
        if ($variableTipo1 == true) {          //Completa la sentencia
            echo nl2br("La primera variable contiene un valor que no es falso o cero, pero no sabemos si es booleano: $variableTipo1.\n");
        }if ($variableTipo2 === "true") {         //Completa la sentencia
            echo nl2br("La segunda variable contiene un valor que no es falso o cero, y es de tipo cadena: $variableTipo2\n");
        }if ($variableTipo3 === false) {         //Completa la sentencia
            echo nl2br("La tercera variable contiene un valor falso o cero,  y es de tipo booleano: $variableTipo3\n");
        }

//1.b) Utilizando las funciones propias de php
        if (!is_bool($variableTipo1)) {
            echo nl2br("La primera variable contiene el valor ..... y no es de tipo booleano. \n");
        }
        if (is_string($variableTipo2)) {
            echo nl2br("La segunda variable contiene el valor ..... y es de tipo cadena. \n");
        }
        if (is_bool($variableTipo3)) {
            echo nl2br("La tercera variable contiene el valor ..... y es de tipo booleano. \n");
        }

//Ejercicio 2. Buscar en el array $arrayTipos el elemento "9" e imprimir un 
//mensaje indicando la posición en la que se encuentra
//Utiliza las funciones propias de php
        $posicion = array_search("9", $arrayTipos);
        if ($posicion) {
            echo nl2br("El elemento '9' se encuentra en el array, en en la posición $posicion.\n");
        } else
            echo nl2br("El elemento '9' no se encuentra en el array.\n");

//Ejercicio 3. Recorrer el array $arrayTipos y mostramos un mensaje adecuado 
//al tipo de dato que contenga ("En la posición hay un .....") y el dato.
        foreach ($arrayTipos as $posicion => $contenido) {
            switch (gettype($contenido)) {
                case "string":
                    echo nl2br("En la posición $posicion hay un elemento de tipo cadena.\n");
                    break;
                case "boolean":
                    echo nl2br("En la posición $posicion hay un elemento de tipo booleano.\n");
                    break;
                case "integer":
                    echo nl2br("En la posición $posicion hay un elemento de tipo entero.\n");
                    break;
                case "double":
                    echo nl2br("En la posición $posicion hay un elemento de tipo real.\n");
                    break;
            }

// Ejercicio 4. Recorrer el array $arrayBiDimensional y mostrar en una tabla HTML el contenido en una tabla, en la que:
// Los días de la semana se coloquen por filas: lunes - martes - miercoles - jueves - viernes
// Cada día de la semana tenga un color de fondo distinto
// Los días que caigan en fin de semana tengan el color de fondo amarillo
        }
        ?>
        <table border = 1>
            <tr style = "background-color:grey">
                <th>LUNES</th>
                <th>MARTES</th>
                <th>MIERCOLES</th>
                <th>JUEVES</th>
                <th>VIERNES</th>
                <th>SABADO</th>
                <th>DOMINGO</th>
            </tr>
            <?php
            //BUSCAMOS EL DIA QUE CONTENGA LA FECHA 1
            foreach ($arrayBiDimensional as $dia => $fecha) {
                if (in_array(1, $fecha)) {
                    $inicio = $dia;
                }
            }
            /*LUNES SERA EL DIA 1, POR LO TANTO PARA SABER DONDE EMPEZAMOS A RELLENAR
             * EL CALENDARIO LE ASIGNAREMOS UN VALOR QUE IRA DECRECIENDO EN 1 SEGUN
             * SE ALEJE DEL LUNES
             */
                switch ($inicio) {
                    case "lunes":
                        $inicio = 1;
                        break;
                    case "martes":
                        $inicio = 0;
                        break;
                    case "miercoles":
                        $inicio = -1;
                        break;
                    case "jueves":
                        $inicio = -2;
                        break;
                    case "viernes":
                        $inicio = -3;
                        break;
                    case "domingo":
                        $inicio = -5;
                        break;
                    default: $inicio = -4;                     
                }
                $diaSemana = 1;
                $colores = ["red","lightblue","green","orange","purple","yellow","yellow"];
                for ($dias = $inicio; $dias <= 31; $dias++) {
                    //CADA VEZ QUE VOLVAMOS AL LUNES IMPRIMIMOS UNA NUEVA FILA
                    if ($diaSemana == 1) {
                        ?>
                        <tr>
                        <?php
                    }
                    ?>
                        <td style = "background-color: <?php echo $colores[$diaSemana-1]?>">
                        <?php
                        /*SI LA FECHA ACTUAL NO SE ENCUENTRA EN EL ARRAY ENTONCES
                         * SE IMPRIME UNA CELDA VACIA, UNA VEZ ENCONTRADAS LAS 
                         * FECHAS SE IMPRIMEN CON NORMALIDAD
                         */                     
                        foreach ($arrayBiDimensional as $dia => $fecha) {
                            foreach ($fecha as $valor) {
                                if ($valor == $dias) {
                                    echo $valor;
                                }
                            }
                        }
                        ?>
                        </td>
                            <?php
                            //REINICIAMOS LOS DIAS DE LA SEMANA Y CERRAMOS LA FILA
                            if ($diaSemana == 7) {
                                ?>
                        </tr>
                            <?php
                            $diaSemana = 0;
                        }
                        ?>
                    <?php
                    //AVANZAMOS UN DIA EN LA SEMANA
                    $diaSemana++;
                }
                ?>
        </table>
    </body>
</html>



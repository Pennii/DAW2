<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './validaciones.php';
        try {
            $conexion = new mysqli("localhost", "root", "", "espectaculos");
        } catch (Exception $exc) {
            exit("No se ha podido conectar a la base de datos " . $exc->getMessage());
        }
        //obtenemos los nombres de todos los actores
        try {
            $consultaActores = $conexion->stmt_init();
            $consultaActores->prepare("SELECT NOMBRE FROM ACTOR;");
            $ejecutado = $consultaActores->execute();
        } catch (Exception $exc) {
            exit("Error al realizar la consulta de actores" . $exc->getMessage());
        }
        if ($ejecutado) {
            //si se pudo ejecutar la consulta preparada generamos la tabla con los nombres
            $resultado = $consultaActores->get_result();
            ?>
            <form method="get" action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>">
                <table border="1">
                    <?php
                    while ($fila = $resultado->fetch_row()) {
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="actores[]" value="<?php echo $fila[0] ?>"> 
                            </td>
                            <td>
                                <?php echo $fila[0]; ?>
                            </td>

                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
                try {
                    //repito el proceso para el select con el nombre de espectaculos
                    $consultaEspectaculos = $conexion->stmt_init();
                    $consultaEspectaculos->prepare("SELECT NOMBRE FROM ESPECTACULO;");
                    $ejecutado = $consultaEspectaculos->execute();
                } catch (Exception $exc) {
                    exit("Error al realizar la consulta de espectaculos " . $exc->getMessage());
                }
                if ($ejecutado) {
                    ?>
                    <br>
                    <label>Seleccione un espectaculo</label>
                    <br>
                    <br>
                    <select name="espectaculo">
                        <?php
                        $resultado = $consultaEspectaculos->get_result();
                        while ($fila = $resultado->fetch_row()) {
                            ?>
                            <option value="<?php echo $fila[0]; ?>"><?php echo $fila[0]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                } else {
                    exit("No se ha podido mostrar la tabla de espectaculos");
                }
                ?>
                <br>
                <br>
                <button value="1" name="enviar">Enviar</button>
            </form>
            <?php
        } else {
            echo "No se ha podido mostrar una tabla de actores";
        }
        if ($campos = filter_input_array(INPUT_GET)) {
            //una vez enviado el formulario verificamos si esta completo y si los datos son validos
            if (count($campos) == 3) {
                $campos['actores'] = validar_actor($campos['actores']);
                $campos['espectaculo'] = validar_espectaculo($campos['espectaculo']);
                if ($campos['actores'] && $campos['espectaculo']) {
                    //creamos la variable que almacenara los codigos de actor seleccionados
                    $codigos = [];
                    foreach ($campos['actores'] as $actor) {
                        //por cada nombre de actor almacenamos su codigo
                        try {
                            $consultaCodigoActor = $conexion->stmt_init();
                            $consultaCodigoActor->prepare("SELECT CDACTOR FROM ACTOR WHERE NOMBRE = ?;");
                            $consultaCodigoActor->bind_param('s', $actor);
                            $consultaCodigoActor->execute();
                        } catch (Exception $exc) {
                            exit("Error al obtener los codigos de los actores " . $exc->getMessage());
                        }
                        $resultado = $consultaCodigoActor->get_result();
                        $codigo = $resultado->fetch_row();
                        array_push($codigos, $codigo[0]);
                    }

                    try {
                        //obtenemos el codigo de espectaculo
                        $consultaCodigoEspectaculo = $conexion->stmt_init();
                        $consultaCodigoEspectaculo->prepare("SELECT CDESPEC FROM ESPECTACULO WHERE NOMBRE = ?;");
                        $consultaCodigoEspectaculo->bind_param("s", $campos['espectaculo']);
                        $consultaCodigoEspectaculo->execute();
                    } catch (Exception $exc) {
                        exit("Error al obtener el codigo de espectaculo " . $exc->getMessage());
                    }
                    $resultado = $consultaCodigoEspectaculo->get_result();
                    $codigo = $resultado->fetch_row();
                    $codigoEspectaculo = $codigo[0];

                    //establecemos el dia y horas que tendran los registros de interviene
                    $dia = date("Y-m-d");
                    $horas = 30;
                    //esta variable nos dira si algun actor existe en la obra seleccionada
                    $existente = false;
                    foreach ($codigos as $cod) {
                        try {
                            //verificamos si el actor ya pertenece a esa obra
                            $consultaInterviene = $conexion->stmt_init();
                            $consultaInterviene->prepare("SELECT CDESPEC, CDACTOR FROM INTERVIENE WHERE CDACTOR = ? AND CDESPEC = ?;");
                            $consultaInterviene->bind_param('ss', $cod, $codigoEspectaculo);
                            $consultaInterviene->execute();
                        } catch (Exception $ex) {
                            exit("Error al realizar la consulta de interviene " . $ex->getMessage());
                        }
                        $resultado = $consultaInterviene->get_result();
                        //si no hay registros quiere decir que el actor no pertenece a la obra
                        if ($resultado->num_rows == 0) {
                            try {
                                $crearRegistroInterviene = $conexion->stmt_init();
                                $crearRegistroInterviene->prepare("INSERT INTO INTERVIENE VALUES (?,?,?,?)");
                                $crearRegistroInterviene->bind_param('ssis', $codigoEspectaculo, $cod, $horas, $dia);
                                $crearRegistroInterviene->execute();
                            } catch (Exception $ex) {
                                exit("Error al insertar datos en interviene " . $ex->getMessage());
                            }
                            //si el actor pertenece a la obra cambiamos el valor de existente
                        } else {
                            $existente = true;
                        }
                    }
                    if (!$existente) {
                        $salida = "Se han agregado los actores: ";
                        foreach ($campos['actores'] as $actor) {
                            $salida .= "-$actor ";
                        }
                        $salida .= "al espectaculo " . $campos["espectaculo"];
                    }else{
                        $salida = "Algunos actores ya estaban registrados para la obra, los que no hayan estado han sido agregados";
                    }
                } else {
                    $salida = "Campos invalidos";
                }
            } else {
                $salida = "Faltan llenar campos";
            }
        } else {
            $salida = "Rellena todos los campos";
        }
        echo $salida;
        $conexion->close();
        ?>
    </body>
</html>

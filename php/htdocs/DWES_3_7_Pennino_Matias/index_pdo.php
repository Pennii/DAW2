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
            $conexion = new PDO('mysql:host=localhost;dbname=espectaculos', 'root', '');
        } catch (Exception $exc) {
            exit("No se ha podido conectar a la base de datos " . $exc->getMessage());
        }
        //obtenemos los nombres de todos los actores
        try {
            $consultaActores = $conexion->prepare("SELECT NOMBRE FROM ACTOR;");
            $ejecutado = $consultaActores->execute();
        } catch (Exception $exc) {
            exit("Error al realizar la consulta de actores" . $exc->getMessage());
        }
        if ($ejecutado) {
            //si se pudo ejecutar la consulta preparada generamos la tabla con los nombres
            ?>
            <form method="get" action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>">
                <table border="1">
                    <?php
                    while ($fila = $consultaActores->fetch(PDO::FETCH_NUM)) {
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
                    $consultaEspectaculos = $conexion->prepare("SELECT NOMBRE FROM ESPECTACULO;");
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
                        while ($fila = $consultaEspectaculos->fetch(PDO::FETCH_NUM)) {
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
                $campos['actores'] = validar_actor_pdo($campos['actores']);
                $campos['espectaculo'] = validar_espectaculo_pdo($campos['espectaculo']);
                if ($campos['actores'] && $campos['espectaculo']) {
                    //creamos la variable que almacenara los codigos de actor seleccionados
                    $codigos = [];
                    foreach ($campos['actores'] as $actor) {
                        try {
                            //por cada nombre de actor almacenamos su codigo
                            $consultaCodigoActor = $conexion->prepare("SELECT CDACTOR FROM ACTOR WHERE NOMBRE = :nom;");
                            $consultaCodigoActor->bindParam(':nom', $actor);
                            $consultaCodigoActor->execute();
                        } catch (Exception $exc) {
                            exit("Error al obtener los codigos de los actores " . $exc->getMessage());
                        }
                        $codigo = $consultaCodigoActor->fetch(PDO::FETCH_NUM);
                        array_push($codigos, $codigo[0]);
                    }

                    try {
                        //obtenemos el codigo de espectaculo
                        $consultaCodigoEspectaculo = $conexion->prepare("SELECT CDESPEC FROM ESPECTACULO WHERE NOMBRE = :nom;");
                        $consultaCodigoEspectaculo->bindParam(":nom", $campos['espectaculo']);
                        $consultaCodigoEspectaculo->execute();
                    } catch (Exception $exc) {
                        exit("Error al obtener el codigo de espectaculo " . $exc->getMessage());
                    }
                    $codigo = $consultaCodigoEspectaculo->fetch(PDO::FETCH_NUM);
                    $codigoEspectaculo = $codigo[0];

                    //establecemos el dia y horas que tendran los registros de interviene
                    $dia = date("Y-m-d");
                    $horas = 30;
                    //esta variable nos dira si algun actor existe en la obra seleccionada
                    $existente = false;
                    foreach ($codigos as $cod) {
                        try {
                            //verificamos si el actor ya pertenece a esa obra
                            $consultaInterviene = $conexion->prepare("SELECT CDESPEC, CDACTOR FROM INTERVIENE WHERE CDACTOR = :act AND CDESPEC = :espec;");
                            $consultaInterviene->bindParam(':act', $cod);
                            $consultaInterviene->bindParam(':espec', $codigoEspectaculo);
                            $consultaInterviene->execute();
                        } catch (Exception $ex) {
                            exit("Error al realizar la consulta de interviene " . $ex->getMessage());
                        }
                        //si no hay registros quiere decir que el actor no pertenece a la obra
                        if ($consultaInterviene->rowCount() == 0) {
                            try {
                                $crearRegistroInterviene = $conexion->prepare("INSERT INTO INTERVIENE VALUES (:espec,:act,:hor,:dia)");
                                $crearRegistroInterviene->bindParam(':espec', $codigoEspectaculo);
                                $crearRegistroInterviene->bindParam(':act', $cod);
                                $crearRegistroInterviene->bindParam(':hor', $horas);
                                $crearRegistroInterviene->bindParam(':dia', $dia);
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
                    } else {
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
        ?>
    </body>
</html>

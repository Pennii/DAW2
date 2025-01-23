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
        //Utilizo el exit en los catch para que el programa no siga ejecutandose al haber errores
        try {
            $conexion = new mysqli('localhost', 'root', '', 'espectaculos');
        } catch (Exception $exc) {
            exit("Error al conectar con la base de datos". $exc->getMessage());
        }

        try {
            $consultaInvisibles = $conexion->query("SELECT * FROM GRUPO WHERE nombre = 'Los invisibles';");
        } catch (Exception $exc) {
            $conexion->close();
            exit("Error al realizar la consulta de grupo". $exc->getMessage());
        }
        if ($consultaInvisibles->num_rows > 0) {
            try {
                $consultaRizaos = $conexion->query("SELECT * FROM GRUPO WHERE nombre = 'Los rizaos';");
            } catch (Exception $exc) {
                $conexion->close();
                exit("Error al realizar la consulta de grupo". $exc->getMessage());
            }
            if ($consultaRizaos->num_rows == 0) {
                try {
                    $conexion->begin_transaction();
                    $crearGrupo = $conexion->query("INSERT INTO GRUPO VALUES('08', 'Los rizaos', 'Almeria');");
                    echo "Se ha creado el grupo 'Los rizaos'";
                    ?><br><?php
                    $conexion->commit();
                } catch (Exception $exc) {
                    $conexion->rollback();
                    $conexion->close();
                    exit("error al crear grupo rizaos". $exc->getMessage());
                }
            }
            try {
                $conexion->begin_transaction();
                $actualizarEspectaculos = $conexion->query("UPDATE ESPECTACULO SET cdgru = (SELECT cdgrupo FROM GRUPO WHERE nombre = 'Los rizaos') WHERE cdgru = (SELECT cdgrupo FROM GRUPO WHERE nombre = 'Los invisibles');");
                echo "Se han actualizado $conexion->affected_rows filas de espectaculo";
                ?><br><?php
                $actualizarActor = $conexion->query("UPDATE ACTOR SET cdgrupo = (SELECT cdgrupo FROM GRUPO WHERE nombre = 'Los rizaos') WHERE cdgrupo = (SELECT cdgrupo FROM GRUPO WHERE nombre = 'Los invisibles');");
                echo "Se han actualizado $conexion->affected_rows filas de actores";
                ?><br><?php
                $conexion->commit();
            } catch (Exception $exc) {
                $conexion->rollback();
                $conexion->close();
                exit("error al actualizar las tablas". $exc->getMessage());
            }
            try {
                $conexion->begin_transaction();
                $borrarGrupo = $conexion->query("DELETE FROM GRUPO WHERE nombre = 'Los invisibles';");
                echo "Se ha elminiado la de la tabla el grupo 'Los invisibles'";
                ?><br><?php
                $conexion->commit();
            } catch (Exception $exc) {
                $conexion->rollback();
                $conexion->close();
                exit("error al eliminar las tablas" . $exc->getMessage());
            }
        } else {
            echo "No existe el grupo los invisibles";
        }
        ?>
    </body>
</html>

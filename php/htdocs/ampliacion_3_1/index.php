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
        $conexion = new mysqli('localhost', 'root', '', 'espectaculos');
        try {
            $consultaCodigos = $conexion->query('SELECT CDGRUPO, NOMBRE FROM GRUPO');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, 'PHP_SELF'); ?>" method="get">
            <select name="grupo">
                <?php
                while ($fila = $consultaCodigos->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $fila['CDGRUPO']; ?>"><?php echo $fila['NOMBRE']; ?></option>
                    <?php
                }
                ?>
            </select>
            <button name="buscar" value="1">Buscar</button> 
        </form>
        <?php
        if (filter_has_var(INPUT_GET, 'buscar')) {
            $codigoGrupo = filter_input(INPUT_GET, 'grupo');
            $codigoGrupo = validarCodigo($codigoGrupo);
            if ($codigoGrupo) {
                try {
                    $consultaActores = $conexion->stmt_init();
                    $consultaActores->prepare('SELECT * FROM ACTOR WHERE CDGRUPO = ?');
                    $consultaActores->execute([$codigoGrupo]);
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                }
                $resultado = $consultaActores->get_result();
                if ($resultado->num_rows > 0) {
                    ?>
                    <form action="<?php echo filter_input(INPUT_SERVER, 'PHP_SELF') ?>" method="get">
                        <table border="1">
                            <?php while ($fila = $resultado->fetch_assoc()) {
                                ?>
                                <tr>
                                    <?php
                                    foreach ($fila as $nombre => $campo) {
                                        ?><td>
                                            <?php echo $campo; ?>
                                        </td>
                                    <?php }
                                    ?>
                                    <td><button name="modificar" value="<?php echo $fila['cdactor']; ?>">Modificar</button></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </form>
                    <?php
                } else {
                    echo 'NO HAY ACTORES AQUI';
                }
            }
        } else if (filter_has_var(INPUT_GET, 'modificar')) {
            $codigoActor = filter_input(INPUT_GET, 'modificar');
            $codigoActor = validarActor($codigoActor);
            try {
                $datosActor = $conexion->stmt_init();
                $datosActor->prepare('SELECT * FROM ACTOR WHERE CDACTOR = ?');
                $datosActor->bind_param('s', $codigoActor);
                $datosActor->execute();
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            $resultado = $datosActor->get_result()->fetch_assoc();
            ?>
            <form action="<?php echo filter_input(INPUT_SERVER, 'PHP_SELF') ?>" method="get">
                <?php
                foreach ($resultado as $nombre => $campo) {
                    if ($nombre !== 'nombre' && $nombre !== 'cache_base') {
                        ?>
                        <input type="hidden" name="<?php echo $nombre; ?>" value="<?php echo $campo; ?>">
                        <?php
                    }else{
                        ?><label><?php echo $nombre; ?></label>
                        <input type="text" name="<?php echo $nombre; ?>" value="<?php echo $campo; ?>">
                        <br> 
                        <?php
                    }
                }
                ?>
                <button name="actualizar">Modificar</button>
            </form>
            <?php
        } else if (filter_has_var(INPUT_GET, 'actualizar')) {
            $datosActor = filter_input_array(INPUT_GET);
            try {
                $actualizarActor = $conexion->stmt_init();
                $actualizarActor->prepare('UPDATE ACTOR SET NOMBRE = ?, CACHE_BASE = ? WHERE CDACTOR = ?');
                $actualizarActor->bind_param('sds', $datosActor['nombre'], $datosActor['cache_base'], $datosActor['cdactor']);
                $actualizarActor->execute();
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            echo 'Se ha modificado el actor';
        }
        ?>
    </body>
</html>

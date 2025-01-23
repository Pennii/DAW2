<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './validaciones.php';
        $conexion = mysqli_connect('localhost', 'root', '', 'espectaculos');
        try {
            $consultaCodigos = mysqli_query($conexion, 'SELECT CDGRUPO, NOMBRE FROM GRUPO');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, 'PHP_SELF'); ?>" method="get">
            <select name="grupo">
                <?php
                while ($fila = mysqli_fetch_assoc($consultaCodigos)) {
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
                    $consultaActores = mysqli_stmt_init($conexion);
                    mysqli_prepare($consultaActores, 'SELECT * FROM ACTOR WHERE CDGRUPO = ?');
                    mysqli_execute($consultaActores, [$codigoGrupo]);
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                }
                $resultado = mysqli_stmt_get_result($consultaActores);
                if (mysqli_num_rows($resultado)) {
                    ?>
                    <form action="<?php echo filter_input(INPUT_SERVER, 'PHP_SELF') ?>" method="get">
                        <table border="1">
                            <?php while ($fila = mysqli_fetch_assoc($resultado)) {
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
                $datosActor = mysqli_stmt_init($conexion);
                mysqli_prepare($datosActor, 'SELECT * FROM ACTOR WHERE CDACTOR = ?');
                mysqli_stmt_bind_param($datosActor,'s', $codigoActor);
                mysqli_execute($datosActor);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            $resultado = mysqli_fetch_assoc(mysqli_stmt_get_result($datosActor));
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
                $actualizarActor = mysqli_stmt_init($conexion);
                mysqli_prepare($actualizarActor,'UPDATE ACTOR SET NOMBRE = ?, CACHE_BASE = ? WHERE CDACTOR = ?');
                mysqli_stmt_bind_param($actualizarActor,'sds', $datosActor['nombre'], $datosActor['cache_base'], $datosActor['cdactor']);
                mysqli_execute($actualizarActor);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            echo 'Se ha modificado el actor';
        }
        ?>
    </body>
</html>

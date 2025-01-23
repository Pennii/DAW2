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
        require_once './funciones.php';
        try {
            $conexion = new mysqli("localhost", "root", "", "espectaculos");
        } catch (Exception $exc) {
            exit("Error al crear la conexion con la base de datos " . $exc->getMessage());
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF") ?>" method="get">
            <label>Codigo espectaculo</label>
            <input type="text" name="codEsp">
            <br>
            <br>
            <label>Nombre</label>
            <input type="text" name="nombre">
            <br>
            <br>
            <label>Tipo</label>
            <br>
            <?php
            try {
                $consultaTipo = $conexion->stmt_init();
                $consultaTipo->prepare("SELECT DISTINCT TIPO FROM ESPECTACULO");
                $consultaTipo->execute();
            } catch (Exception $exc) {
                exit("Error al seleccionar los datos de los grupos " . $exc->getMessage());
            }
            $resultados = $consultaTipo->get_result();
            while ($fila = $resultados->fetch_assoc()) {
                ?>
                <label><?php echo $fila["TIPO"] ?></label>
                <input type="radio" name="tipo" value="<?php echo $fila['TIPO'] ?>">
                <?php
            }
            $consultaTipo->close();
            ?>
            <br>
            <br>
            <label>Estrellas</label>
            <br>
            <select name="estrellas">
                <option value="0">Seleccione una opcion</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br>
            <br>
            <label>Grupo</label>
            <br>
            <?php
            try {
                $consultaGrupo = $conexion->stmt_init();
                $consultaGrupo->prepare("SELECT CDGRUPO, NOMBRE FROM GRUPO");
                $consultaGrupo->execute();
            } catch (Exception $exc) {
                exit("Error al seleccionar los datos de los grupos " . $exc->getMessage());
            }
            $resultados = $consultaGrupo->get_result();
            while ($fila = $resultados->fetch_assoc()) {
                ?>
                <label><?php echo $fila["NOMBRE"] ?></label>
                <input type="radio" name="codGru" value="<?php echo $fila['CDGRUPO'] ?>">
                <?php
            }
            $consultaGrupo->close();
            ?>
            <br>
            <br>
            <button>Enviar</button>
            <?php if (filter_input_array(INPUT_GET)) { ?>
            <input type="text" name="codOcul" value="<?php echo filter_input(INPUT_GET, "codEsp") ?>" style="display:none">
                <input type="text" name="gruOcul" value="<?php echo filter_input(INPUT_GET, "codGru") ?>"style="display:none">
            <?php } ?>
        </form>
        <?php
        if ($campos = filter_input_array(INPUT_GET)) {
            if (filter_has_var(INPUT_GET, "codEsp") && filter_has_var(INPUT_GET, "nombre") && filter_has_var(INPUT_GET, "tipo") && filter_has_var(INPUT_GET, "codGru")) {
                $campos["codEsp"] = validar_codigo($campos["codEsp"]);
                $campos["nombre"] = validar_nombre($campos["nombre"]);
                $campos["tipo"] = validar_tipo($campos["tipo"]);
                $campos["estrellas"] = validar_estrellas($campos["estrellas"]);
                $campos["codGru"] = validar_grupo($campos["codGru"]);
                if ($campos["codEsp"] && $campos["nombre"] && $campos["tipo"] && $campos["codGru"]) {
                    if (!codigo_disponible($campos["codEsp"])) {
                        $salida = "Ya existe el espectaculo con ese codigo";
                    } else {
                        try {
                            $conexion->begin_transaction();
                            $insertarEsp = $conexion->stmt_init();
                            $insertarEsp->prepare("INSERT INTO ESPECTACULO VALUES(?,?,?,?,?)");
                            if ($campos["estrellas"]) {
                                $insertarEsp->bind_param("sssis", $campos["codEsp"], $campos["nombre"], $campos["tipo"], $campos["estrellas"], $campos["codGru"]);
                            } else {
                                $nulo = null;
                                $insertarEsp->bind_param("sssis", $campos["codEsp"], $campos["nombre"], $campos["tipo"], $nulo, $campos["codGru"]);
                            }
                            $insertarEsp->execute();
                            $conexion->commit();
                        } catch (Exception $exc) {
                            $conexion->rollback();
                            exit("Error al insertar espectaculo " . $exc->getMessage());
                        }

                        $salida = "Se ha agregado el espectaculo con exito";
                    }
                }else{
                    $salida = "error al cargar datos";
                }
            } else {
                $salida = "Falta llenar campos";
            }
            echo $salida;
        }
        ?>
    </body>
</html>

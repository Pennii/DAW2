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
        $cantidad = 4;
        $campos = filter_input_array(INPUT_GET);
        $enviado = !is_null($campos);
        if ($enviado) {
            $completo = $cantidad == count($campos);
            if ($completo) {
                $campos["nombre"] = validar_nombre($campos["nombre"]);
                $campos["anio"] = validar_anio($campos["anio"]);
                $campos["modulo"] = validar_modulo($campos["modulo"]);
            }
            print_r($campos);
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="get">
            <label>Introduce un nombre:</label>
            <input type="text" name="nombre" value="<?php if (filter_has_var(INPUT_GET, "nombre")) echo filter_input(INPUT_GET, "nombre"); ?>"><br><br>
            <label>Introduce una año de nacimiento:</label>
            <input type="text" name="anio" value="<?php if (filter_has_var(INPUT_GET, "anio")) echo filter_input(INPUT_GET, "anio"); ?>"><br><br>
            <label>Introduce un modulo:</label><br>
            <input type="checkbox" name="modulo[]" value = "DWES" <?php if (filter_has_var(INPUT_GET, "modulo") && $campos["modulo"] != false && in_array("DWES", $campos["modulo"])) echo "checked"; ?>><label>DWES</label>
            <input type="checkbox" name="modulo[]" value = "DWEC" <?php if (filter_has_var(INPUT_GET, "modulo") && $campos["modulo"] != false && in_array("DWEC", $campos["modulo"])) echo "checked"; ?>><label>DWEC</label>
            <input type="checkbox" name="modulo[]" value = "FOL" <?php if (filter_has_var(INPUT_GET, "modulo") && $campos["modulo"] != false && in_array("FOL", $campos["modulo"])) echo "checked"; ?>><label>FOL</label>
            <input type="checkbox" name="modulo[]" value = "DIW" <?php if (filter_has_var(INPUT_GET, "modulo") && $campos["modulo"] != false && in_array("DIW", $campos["modulo"])) echo "checked"; ?>><label>DIW</label>
            <br><br>
            <button name = "enviar" value = "1">Enviar</button><br><br>
        </form>
        <?php
        if ($enviado) {
            if ($completo) {
                $invalido = false;
                foreach ($campos as $campo) {
                    if (!$campo) {
                        $invalido = true;
                    }
                }
                if (!$invalido) {
                    $modulos = "";
                    foreach ($campos["modulo"] as $modulo) {
                        $modulos = $modulos ." ".$modulo;
                    }
                    $salida = "El usuario ".$campos["nombre"]." nacio en ".$campos["anio"].
                            " y se inscribio en: ".$modulos;
                }
            }
            if (!$completo || $invalido) {
                $salida = "ta mal";
            }
        } else {
            $salida = "ta";
        }
        echo $salida;
        ?>
    </body>
</html>

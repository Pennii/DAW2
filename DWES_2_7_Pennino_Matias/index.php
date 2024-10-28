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
        require_once './funciones_validacion.php';
        $completado = 1;
        $cantidad = 8;
        if (filter_has_var(INPUT_GET, "enviar")) {
            $campos = filter_input_array(INPUT_GET);
            $completado = count($campos) == $cantidad;

            if ($completado) {
                $campos["nombre"] = validar_nombre($campos["nombre"]);
                $campos["edad"] = validar_edad($campos["edad"]);
                $campos["sexo"] = validar_sexo($campos["sexo"]);
                $campos["email"] = validar_email($campos["email"]);
                $campos["aficion"] = validar_aficion($campos["aficion"]);
                $campos["provincias"] = validar_provincia($campos["provincias"]);
                $campos["perfil"] = validar_url($campos["perfil"]);
                print_r($campos);
            }
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="get">
            <label>Introduce un nombre:</label>
            <input type="text" name="nombre" value="<?php if (filter_has_var(INPUT_GET, "nombre")) echo filter_input(INPUT_GET, "nombre"); ?>"><br><br>
            <label>Introduce una edad:</label>
            <input type="text" name="edad" value="<?php if (filter_has_var(INPUT_GET, "edad")) echo filter_input(INPUT_GET, "edad"); ?>"><br><br>
            <label>Introduce un sexo:</label><br>
            <label>Mujer</label><input type="radio" name="sexo" value = "mujer" <?php if (filter_has_var(INPUT_GET, "sexo")) if ($campos["sexo"] == "mujer") echo "checked"; ?>>
            <label>Hombre</label><input type="radio" name="sexo" value = "hombre" <?php if (filter_has_var(INPUT_GET, "sexo")) if ($campos["sexo"] == "hombre") echo "checked"; ?>>
            <br><br>
            <label>Introduce un email:</label>
            <input type="text" name="email" value="<?php if (filter_has_var(INPUT_GET, "email")) echo filter_input(INPUT_GET, "email"); ?>"><br><br>
            <label>Introduce una aficion:</label><br>
            <input type="checkbox" name="aficion[]" value = "deportes" <?php if (filter_has_var(INPUT_GET, "aficion") && $campos["aficion"] != false && in_array("deportes", $campos["aficion"])) echo "checked"; ?>><label>Deportes</label>
            <input type="checkbox" name="aficion[]" value = "musica" <?php if (filter_has_var(INPUT_GET, "aficion") && $campos["aficion"] != false && in_array("musica", $campos["aficion"])) echo "checked"; ?>><label>Musica</label>
            <input type="checkbox" name="aficion[]" value = "alimentacion" <?php if (filter_has_var(INPUT_GET, "aficion") && $campos["aficion"] != false && in_array("alimentacion", $campos["aficion"])) echo "checked"; ?>><label>Alimentacion</label>
            <input type="checkbox" name="aficion[]" value = "moda" <?php if (filter_has_var(INPUT_GET, "aficion") && $campos["aficion"] != false && in_array("moda", $campos["aficion"])) echo "checked"; ?>><label>Moda</label>
            <br><br>
            <label>seleccione una provincia:</label><br>
            <select name = "provincias">
                <option value = "0">Seleccione una opcion</option>
                <option value = "almeria" <?php if (filter_has_var(INPUT_GET, "provincias")) if ($campos["provincias"] == "almeria") echo "selected" ?>>Almeria</option>
                <option value = "granada" <?php if (filter_has_var(INPUT_GET, "provincias")) if ($campos["provincias"] == "granada") echo "selected" ?>>Granada</option>
                <option value = "huelva" <?php if (filter_has_var(INPUT_GET, "provincias")) if ($campos["provincias"] == "huelva") echo "selected" ?>>Huelva</option>
                <option value = "sevilla" <?php if (filter_has_var(INPUT_GET, "provincias")) if ($campos["provincias"] == "sevilla") echo "selected" ?>>Sevilla</option>
                <option value = "malaga" <?php if (filter_has_var(INPUT_GET, "provincias")) if ($campos["provincias"] == "malaga") echo "selected" ?>>Malaga</option>
                <option value = "cadiz" <?php if (filter_has_var(INPUT_GET, "provincias")) if ($campos["provincias"] == "cadiz") echo "selected" ?>>Cadiz</option>
            </select>
            <br><br>
            <label>Introduce la url a tu perfil publico:</label>
            <input type="text" name="perfil" value="<?php if (filter_has_var(INPUT_GET, "perfil")) echo filter_input(INPUT_GET, "perfil"); ?>"><br><br>
            <button name = "enviar" value = "1">Enviar</button><br><br>
            <?php
            $invalido = false;
            if (!filter_has_var(INPUT_GET, "enviar")) {
                $salida = "Rellena todos los campos del formulario";
            } else if ($completado) {
                $aficiones = "sus aficiones son: ";
                foreach ($campos as $campo) {
                    if ($campo == false) {
                        $invalido = true;
                    }
                }
                if (!$invalido) {
                    foreach ($campos["aficion"] as $aficion) {
                        $aficiones = $aficiones . $aficion . " ";
                    }
                    $salida = "El usuario " . $campos["nombre"] . " de " . $campos["edad"] .
                            " años es " . $campos["sexo"] . " se registro en " . $campos["provincias"] .
                            "con el correo " . $campos["email"][0] . ", " . $aficiones.", la url a su perfil "
                            . "publico es: ".$campos["perfil"][0];
                }
            }
            if ($invalido || !$completado) {
                $salida = "Error al cargar el formulario";
            }
            echo $salida;
            ?>
            <br>
            <?php ?>
        </form>
    </body>
</html>

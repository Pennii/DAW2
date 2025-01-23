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
        if (filter_has_var(INPUT_GET, "enviar")) {
            $campos = filter_input_array(INPUT_GET);
            $completado = count($campos) == 6;
        }
        if ($completado) {
            $campos["nombre"] = validar_texto($campos["nombre"]);
            $campos["edad"] = validar_edad($campos["edad"]);
            $campos["sexo"] = validar_sexo($campos["sexo"]);
            $campos["aficion"] = validar_aficion($campos["aficion"]);
            $campos["provincias"] = validar_provincia($campos["provincias"]);
        }
        //print_r($campos);
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="get">
            <label>Introduce un nombre:</label>
            <input type="text" name="nombre" value="<?php if (filter_has_var(INPUT_GET, "nombre")) echo $campos["nombre"]; ?>"><br><br>
            <label>Introduce una edad:</label>
            <input type="text" name="edad" value="<?php if (filter_has_var(INPUT_GET, "edad")) echo $_GET["edad"]; ?>"><br><br>
            <label>Introduce un sexo:</label><br>
            <label>Mujer</label><input type="radio" name="sexo" value = "mujer" <?php if (isset($_GET["sexo"])) if ($_GET["sexo"] == "mujer") echo "checked"; ?>>
            <label>Hombre</label><input type="radio" name="sexo" value = "hombre" <?php if (isset($_GET["sexo"])) if ($_GET["sexo"] == "hombre") echo "checked"; ?>>
            <br><br>
            <label>Introduce una aficion:</label><br>
            <input type="checkbox" name="aficion[]" value = "deportes" <?php if (isset($_GET["aficion"]) && in_array("deportes", $_GET["aficion"])) echo "checked"; ?>><label>Deportes</label>
            <input type="checkbox" name="aficion[]" value = "musica" <?php if (isset($_GET["aficion"]) && in_array("musica", $_GET["aficion"])) echo "checked"; ?>><label>Musica</label>
            <input type="checkbox" name="aficion[]" value = "alimentacion" <?php if (isset($_GET["aficion"]) && in_array("alimentacion", $_GET["aficion"])) echo "checked"; ?>><label>Alimentacion</label>
            <input type="checkbox" name="aficion[]" value = "moda" <?php if (isset($_GET["aficion"]) && in_array("moda", $_GET["aficion"])) echo "checked"; ?>><label>Moda</label>
            <br><br>
            <label>seleccione una provincia:</label><br>
            <select name = "provincias">
                <option value = "0">Seleccione una opcion</option>
                <option value = "almeria" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "almeria") echo "selected" ?>>Almeria</option>
                <option value = "granada" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "granada") echo "selected" ?>>Granada</option>
                <option value = "huelva" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "huelva") echo "selected" ?>>Huelva</option>
                <option value = "sevilla" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "sevilla") echo "selected" ?>>Sevilla</option>
                <option value = "malaga" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "malaga") echo "selected" ?>>Malaga</option>
                <option value = "cadiz" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "cadiz") echo "selected" ?>>Cadiz</option>
            </select>
            <br><br>
            <button name = "enviar" value = "1">Enviar</button><br><br>
            <?php
            $invalido = false;
            if (!filter_has_var(INPUT_GET, "enviar")) {
                $salida = "Rellena todos los campos del formulario";
            } else if ($completado) {
                foreach ($campos as $campo) {
                    if ($campo == false) {
                        $invalido = true;
                    }
                }
                if (!$invalido) {
                    $salida = "El usuario " . $campos["nombre"] . " de " . $campos["edad"] .
                            " años es " . $campos["sexo"] . " se registro en " . $campos["provincias"];
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

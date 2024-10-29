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
        $cantidad = ;
        $campos = filter_input_array(INPUT_GET);
        if (is_array($campos)) {
            $completo = count($campos) == $cantidad;
            if ($completo) {
                $campos["numero1"] = validar_numero($campos["numero1"]);
                $campos["numero2"] = validar_numero($campos["numero2"]);
                $campos["operaciones"] = validar_operacion($campos["operaciones"]);
                print_r($campos);
            }
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="get">
            <label>Ingresa el primer numero</label>
            <input type="text" name="numero1" value="<?php if (filter_has_var(INPUT_GET, "numero1")) echo filter_input(INPUT_GET, "numero1") ?>">
            <br><br>
            <label>Ingresa el segundo numero</label>
            <input type="text" name="numero2" value="<?php if (filter_has_var(INPUT_GET, "numero2")) echo filter_input(INPUT_GET, "numero2") ?>">
            <br><br>
            <label>Mujer</label><input type="radio" name="sexo" value = "mujer" <?php if (isset($_GET["sexo"])) if ($_GET["sexo"] == "mujer") echo "checked"; ?>>
            <label>Hombre</label><input type="radio" name="sexo" value = "hombre" <?php if (isset($_GET["sexo"])) if ($_GET["sexo"] == "hombre") echo "checked"; ?>>
            <br><br>
            <label>Ingresa la operacion</label><br>
            <input type="checkbox" name="operaciones[]" value="suma" <?php if (filter_has_var(INPUT_GET, "operaciones") && $campos["operaciones"] != false && in_array("suma", $campos["operaciones"])) echo "checked"; ?>>
            <label>Suma</label>
            <input type="checkbox" name="operaciones[]" value="resta" <?php if (filter_has_var(INPUT_GET, "operaciones") && $campos["operaciones"] != false && in_array("resta", $campos["operaciones"])) echo "checked"; ?>>
            <label>Resta</label>
            <input type="checkbox" name="operaciones[]" value="multiplicacion" <?php if (filter_has_var(INPUT_GET, "operaciones") && $campos["operaciones"] != false && in_array("multiplicacion", $campos["operaciones"])) echo "checked"; ?>>
            <label>Multiplicacion</label>
            <input type="checkbox" name="operaciones[]" value="division" <?php if (filter_has_var(INPUT_GET, "operaciones") && $campos["operaciones"] != false && in_array("division", $campos["operaciones"])) echo "checked"; ?>>
            <label>Division</label>
            <br><br>
             <select name = "provincias">
                <option value = "0">Seleccione una opcion</option>
                <option value = "almeria" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "almeria") echo "selected" ?>>Almeria</option>
                <option value = "granada" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "granada") echo "selected" ?>>Granada</option>
                <option value = "huelva" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "huelva") echo "selected" ?>>Huelva</option>
                <option value = "sevilla" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "sevilla") echo "selected" ?>>Sevilla</option>
                <option value = "malaga" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "malaga") echo "selected" ?>>Malaga</option>
                <option value = "cadiz" <?php if (isset($_GET["provincias"]) && $_GET["provincias"] == "cadiz") echo "selected" ?>>Cadiz</option>
            </select>
            <button name="enviar" value="1">sumar</button>
        </form>
        <?php
        if (filter_has_var(INPUT_GET, "enviar")) {
            if ($completo) {
                $invalido = false;
                foreach ($campos as $campo) {
                    if ($campo === false) {
                        $invalido = true;
                    }
                }
                if (!$invalido) {
                }
            }
            if (!$completo || $invalido) {
                $salida = "error al ingresar datos";
            }
        } else {
            $salida = "Ingresa datos";
        }
        echo $salida;
        ?>
    </body>
</html>

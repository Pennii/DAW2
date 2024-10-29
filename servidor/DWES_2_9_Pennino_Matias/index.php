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
                    $operaciones = "";
                    foreach ($campos["operaciones"] as $operacion) {
                        switch ($operacion) {
                            case "suma":
                                $operaciones = $operaciones . $campos["numero1"] + $campos["numero2"] . " ";
                                break;
                            case "resta":
                                $operaciones = $operaciones . $campos["numero1"] - $campos["numero2"] . " ";
                                break;
                            case "multiplicacion":
                                $operaciones = $operaciones . $campos["numero1"] * $campos["numero2"] . " ";
                                break;
                            default:
                                if ($campos["numero2"] != 0) {
                                    $operaciones = $operaciones . $campos["numero1"] / $campos["numero2"] . " ";
                                } else {
                                    $operaciones = $operaciones . "division imposible";
                                }
                                break;
                        }
                    }
                    $salida = $operaciones;
                }
            }
            if (!$completo || $invalido) {
                $salida = "error al ingresar datos";
            }
        } else {
            $salida = "Ingresa dos numeros";
        }
        echo $salida;
        ?>
    </body>
</html>

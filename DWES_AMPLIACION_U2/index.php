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
        require_once './validaciones_ampliacion.php';
        const CANTIDAD_CAMPOS = 7;
        $campos = filter_input_array(INPUT_GET);
        if (is_array($campos)) {
            $incompleto = count($campos) != CANTIDAD_CAMPOS || empty($campos["matricula"]) || empty($campos["marcas"]) || empty($campos["modelo"]);
            $valido = false;
            if ($incompleto) {
                $salida = campos_vacios($campos);
            } else {
                $campos["matricula"] = validar_matricula($campos["matricula"]);
                $valido = $campos["matricula"] != "Invalido";
                
                $salida = $valido?"Datos correctos":campos_malos($campos);
            }
        } else {
            $salida = "Ingresa los datos";
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="get">
            <label>Ingresa la matricula</label>
            <input type="text" name="matricula" value="<?php if (filter_has_var(INPUT_GET, "matricula")) echo filter_input(INPUT_GET, "matricula") ?>">
            <br><br>
            <select name = "marcas">
                <option value = "">Seleccione una marca</option>
                <option value = "chrysler" <?php if (filter_has_var(INPUT_GET, "marcas") && filter_input(INPUT_GET, "marcas") == "chrysler") echo "selected" ?>>chrysler</option>
                <option value = "bmw" <?php if (filter_has_var(INPUT_GET, "marcas") && filter_input(INPUT_GET, "marcas") == "bmw") echo "selected" ?>>BMW</option>
                <option value = "audi" <?php if (filter_has_var(INPUT_GET, "marcas") && filter_input(INPUT_GET, "marcas") == "audi") echo "selected" ?>>audi</option>
                <option value = "otro" <?php if (filter_has_var(INPUT_GET, "marcas") && filter_input(INPUT_GET, "marcas") == "otro") echo "selected" ?>>otro</option>  
            </select>
            <br>
            <br>
            <label>Ingresa el modelo</label>
            <input type="text" name="modelo" value="<?php if (filter_has_var(INPUT_GET, "modelo")) echo filter_input(INPUT_GET, "modelo") ?>">
            <br><br>
            <label>Elige un color</label><br>
            <label>blanco</label><input type="radio" name="color" value = "blanco" <?php if (filter_has_var(INPUT_GET, "color")) if (filter_input(INPUT_GET, "color") == "blanco") echo "checked"; ?>>
            <label>negro</label><input type="radio" name="color" value = "negro" <?php if (filter_has_var(INPUT_GET, "color")) if (filter_input(INPUT_GET, "color") == "negro") echo "checked"; ?>>
            <label>rojo</label><input type="radio" name="color" value = "rojo" <?php if (filter_has_var(INPUT_GET, "color")) if (filter_input(INPUT_GET, "color") == "rojo") echo "checked"; ?>>
            <label>otro</label><input type="radio" name="color" value = "otro" <?php if (filter_has_var(INPUT_GET, "color")) if (filter_input(INPUT_GET, "color") == "otro") echo "checked"; ?>>
            <br><br>
            <table border="1">
                <tr>
                    <th>Seleccionar</th>
                    <th>Reparacion</th>
                    <th>Precio</th>
                </tr>
                <tr>
                    <td><input type="checkbox" name="reparacion[]" value="aceite"></td>
                    <td>cambio de aceite</td>
                    <td>65</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="reparacion[]" value="filtro"></td>
                    <td>cambio de filtros</td>
                    <td>87</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="reparacion[]" value="distribucion"></td>
                    <td>correa de distribucion</td>
                    <td>950</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="reparacion[]" value="neumaticos"></td>
                    <td>cambio de 2 neumaticos</td>
                    <td>225</td>
                </tr>
            </table>
            <br><br>
            <button name="precioSinIva" value="1">Calcular precio</button>
            <input type="text" disabled="disabled" style="display:<?php echo filter_has_var(INPUT_GET, "precioSinIva") ? "inline-block" : "none" ?>"
                   <?php if (filter_has_var(INPUT_GET, "precioSinIva") && filter_has_var(INPUT_GET, "reparacion") && $valido) echo "value=" . precio_bruto($campos["reparacion"]); ?>>
            <br><br>
            <label>Ingresa el iva a calcular</label>
            <select name="iva">
                <option value="18">18%</option>
                <option value="21">21%</option>
            </select>
            <br><br>
            <button name="precioConIva" value="1">Calcular precio</button>
            <input type="text" disabled="disabled" style="display:<?php echo filter_has_var(INPUT_GET, "precioConIva") ? "inline-block" : "none" ?>">
        </form>
        <?php
        echo $salida;
        ?>
    </body>
</html>
